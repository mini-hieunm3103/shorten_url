<?php

namespace Modules\Client\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Tag\app\Http\Repositories\TagRepository;
use Modules\Url\app\Http\Repositories\UrlRepository;
use Modules\User\app\Repositories\UserRepository;
use Termwind\Components\Dd;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userRepo;
    protected $urlRepo;
    protected $tagRepo;
    public function __construct( UserRepository $userRepo, UrlRepository $urlRepo, TagRepository $tagRepo)
    {
        $this->userRepo = $userRepo;
        $this->urlRepo = $urlRepo;
        $this->tagRepo = $tagRepo;
    }
    function home()
    {
        return view('client::home');
    }
    function links(Request $request)
    {
        preg_match_all('/^(?:https?:\/\/)?(?:[^@\n]+@)?(?:www\.)?([^:\/\n?]+)/im', request()->root(), $matches);
        $domain = ($matches[1][0]);
        $title = 'Links';
        $filterApplied = 0;

        // filter by tags
        $relatedUrlIds = [];
        $tagsFilterArr = [];
        if (!empty($request->input('tags'))){
            $filterApplied += 1;
            $tagsFilterName = $request->input('tags');
            foreach ($tagsFilterName as $name) {
                $tagsFilter = $this->tagRepo->getUserTags(auth()->user()->id)->where('title', $name)->first();
                $tagsFilterArr[] = $tagsFilter;
                $relatedUrlIds[] = $this->tagRepo->getRelatedUrls($tagsFilter);
            }
            $mergedArray = call_user_func_array('array_merge', $relatedUrlIds);
            $relatedUrlIds = array_unique($mergedArray);
            $relatedUrlIds = array_values($relatedUrlIds);
        }

        $urls = $this->urlRepo->getUserUrls(auth()->user()->id)->orderBy('updated_at', 'desc')
            ->when(true, function ($query) use ($request, $relatedUrlIds, &$filterApplied) {
                if (!empty($relatedUrlIds)) {
                    $query->whereIn('id', $relatedUrlIds);
                }
                // check link custom
                if (!empty($request->input('custom_link')) && $request->input('custom_link') == "on"){
                    $filterApplied+=1;
                    $query->where('is_custom', 1);
                } elseif (!empty($request->input('custom_link')) && $request->input('custom_link') == "off"){
                    $filterApplied+=1;
                    $query->where('is_custom', 0);
                }
                // check created date
                if (!empty($request->input('created_after')) && !empty($request->input('created_before'))) {
                    $filterApplied+=1;
                    $createdAfter = Carbon::createFromTimestamp($request->input('created_after'))->format('Y-m-d H:i:s');
                    $createdBefore = Carbon::createFromTimestamp($request->input('created_before'))->format('Y-m-d H:i:s');
//                    \dd($createdBefore, $createdAfter);
                    $query->where('created_at', '>', $createdAfter)->where('created_at', '<', $createdBefore);
                }
                if (request()->input('archived') == 'off'){
                    $filterApplied+=1;
                    $query->where('archived', '0');
                } else{
                    $query->where('archived', '1');
                }
            })
            ->get();
        $allTags = $this->tagRepo->getUserTags(auth()->user()->id)->get();
        foreach ($urls as $url) {
            $tagIds = $this->urlRepo->getRelatedTags($url);
            if (!empty($tagIds)) {
                $relatedTags = [];
                foreach ($allTags as $tag) {
                    if (in_array($tag->id, $tagIds)) {
                        $relatedTags[] = $tag;
                    }
                }
                $url->tags = $relatedTags;
            }
        }
//        \dd($tagsFilterArr);
        return view('client::links', compact('title', 'urls', 'domain', 'allTags', 'filterApplied', 'tagsFilterArr'));
    }
    // render form create url
    function createUrl()
    {
        preg_match_all('/^(?:https?:\/\/)?(?:[^@\n]+@)?(?:www\.)?([^:\/\n?]+)/im', request()->root(), $matches);
        $domain = ($matches[1][0]);
        return view('client::create', compact('domain'));
    }
    // handle store new url
    function storeUrl()
    {

    }

    function storeTag()
    {
        // xử lý các kiểu rồi ném dữ liệu và redirect đến store tag của admin
    }
}

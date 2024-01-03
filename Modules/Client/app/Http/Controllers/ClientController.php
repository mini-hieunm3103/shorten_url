<?php

namespace Modules\Client\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Modules\Tag\app\Http\Repositories\TagRepository;
use Modules\Url\app\Http\Repositories\UrlRepository;
use Modules\User\app\Repositories\UserRepository;
use Illuminate\Http\Request;
use Modules\Tag\app\Http\Requests\TagRequest;
use Modules\Url\app\Http\Requests\UrlRequest;
use Modules\User\app\Http\Requests\UserRequest;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userRepo;
    protected $urlRepo;
    protected $tagRepo;
    public function __construct
    (
        UserRepository $userRepo,
        UrlRepository $urlRepo,
        TagRepository $tagRepo,
    )
    {
        $this->userRepo = $userRepo;
        $this->urlRepo = $urlRepo;
        $this->tagRepo = $tagRepo;
    }

    function welcome()
    {
        preg_match_all('/^(?:https?:\/\/)?(?:[^@\n]+@)?(?:www\.)?([^:\/\n?]+)/im', request()->root(), $matches);
        $domain = ($matches[1][0]);
        return view('client::welcome', compact('domain'));
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
        return view('client::links.lists', compact('title', 'urls', 'domain', 'allTags', 'filterApplied', 'tagsFilterArr'));
    }
    // render form create url
    function createUrl()
    {
        preg_match_all('/^(?:https?:\/\/)?(?:[^@\n]+@)?(?:www\.)?([^:\/\n?]+)/im', request()->root(), $matches);
        $domain = ($matches[1][0]);
        return view('client::links.create', compact('domain'));
    }

    function storeUrl(UrlRequest $request)
    {
        $response = App::make('Modules\Url\app\Http\Controllers\UrlController')->callAction('store', [$request]);
        return $response;
    }
    function updateUrl(UrlRequest $request, $id)
    {
        $response = App::make('Modules\Url\app\Http\Controllers\UrlController')->callAction('update', [$request, $id]);
        return $response;
    }

    function hideUrls(Request $request)
    {
        $response = App::make('Modules\Url\app\Http\Controllers\UrlController')->callAction('hideListUrl', [$request]);
        return $response;
    }

    function activeUrls(Request $request)
    {
        $response = App::make('Modules\Url\app\Http\Controllers\UrlController')->callAction('activeListUrl', [$request]);
        return $response;
    }

    function deleteUrl($id)
    {
        $response = App::make('Modules\Url\app\Http\Controllers\UrlController')->callAction('destroy', [$id]);
        return $response;
    }
    function dataUrl($id)
    {
        $response = App::make('Modules\Url\app\Http\Controllers\UrlController')->callAction('data', [$id]);
        return $response;
    }
    function showUrl($shortLink)
    {
        preg_match_all('/^(?:https?:\/\/)?(?:[^@\n]+@)?(?:www\.)?([^:\/\n?]+)/im', request()->root(), $matches);
        $domain = ($matches[1][0]);
        $url = $this->urlRepo->getAllUrls()->where('back_half', $shortLink)->first();
        check404($url);
        return view('client::links.show', compact('url', 'domain'));
    }

    function storeTag(TagRequest $request)
    {
        $response = App::make('Modules\Tag\app\Http\Controllers\TagController')->callAction('store', [$request]);
        return $response;
    }

    function setting()
    {
        return view('client::setting');
    }

    function updateUser(UserRequest $request, $id)
    {
        $response = App::make('Modules\User\app\Http\Controllers\UserController')->callAction('update', [$request, $id]);
        return $response;
    }

    function deleteUser($id)
    {
        $response = App::make('Modules\User\app\Http\Controllers\UserController')->callAction('destroy', [$id]);
        return $response;
    }
}

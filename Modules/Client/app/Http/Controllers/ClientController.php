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
    function links()
    {
//        $id = $this->user->id;
        preg_match_all('/^(?:https?:\/\/)?(?:[^@\n]+@)?(?:www\.)?([^:\/\n?]+)/im', request()->root(), $matches);
        $domain = ($matches[1][0]);
        $title = 'Links';
        $urls = $this->urlRepo->getUserUrls(auth()->user()->id)->get();
        $tags = $this->tagRepo->getUserTags(auth()->user()->id)->get();
        foreach ($urls as $url) {
            $tagIds = $this->urlRepo->getRelatedTags($url);
            if (!empty($tagIds)) {
                $relatedTags = [];
                foreach ($tags as $tag) {
                    if (in_array($tag->id, $tagIds)) {
                        $relatedTags[] = $tag;
                    }
                }
                $url->tags = $relatedTags;
            }
        }
        return view('client::links', compact('title', 'urls', 'tags', 'domain'));
    }
}

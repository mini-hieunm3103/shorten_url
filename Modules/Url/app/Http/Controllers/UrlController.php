<?php

namespace Modules\Url\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Http\RedirectResponse;
use Modules\Url\app\Http\Requests\UrlRequest;
use Illuminate\Support\Facades\Redirect;
use Modules\Url\app\Http\Repositories\UrlRepository;
use Modules\Tag\app\Http\Repositories\TagRepository;
use Modules\User\app\Repositories\UserRepository;

class UrlController extends Controller
{
    protected $urlRepo;
    protected $userRepo;
    protected $tagRepo;
    protected $faker;
    public function __construct
    (
        UrlRepository $urlRepo,
        UserRepository $userRepo,
        TagRepository $tagRepo,
    )
    {
        $this->urlRepo = $urlRepo;
        $this->userRepo = $userRepo;
        $this->tagRepo = $tagRepo;
        $this->faker = Factory::create();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản Lý Shorten URL';
        $urls = $this->urlRepo->getAllUrls()->get();
        return view('url::index', compact('urls', 'title'));
    }
    /**
     * Lấy ra thông tin của người dùng cùng với các shorten url của người đó
     */
    public function show($id)
    {
        $user = $this->userRepo->find($id);
        $urls = $this->urlRepo->getUserUrls($id)->get();
        $user->count_urls = $urls->count();
        $countClicks = 0;
        foreach ($urls as $url) {
            $countClicks += $url->clicks;
        }
        $user->count_clicks = $countClicks;
        return view('url::show', compact('user', 'urls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Shorten URL';
        $users = $this->userRepo->getAllUsers()->get();
        $tags = $this->tagRepo->getAllTags()->get();
        foreach ($tags as $tag) {
            $urlIds = $this->tagRepo->getRelatedUrls($tag);
            $tag->total_urls = count($urlIds);
            $tags[] = $tag;
        }
        return view('url::create', compact('title','users', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UrlRequest $request)
    {
        $backHalfArr = $this->urlRepo->getBackHalf();
        $data = $request->except('_token');
        $data['expired_at'] = Carbon::now()->addDays(30)->format('Y-m-d H:i:s');
        if(empty($data['title'])){
            $data['title'] = 'Untitled '.Carbon::now('UTC')->format('Y-m-d H:i:s');
        }
        if(empty($data['back_half'])){
            $data['back_half'] = $this->getBackHalf($backHalfArr);
        }
        $url = $this->urlRepo->create($data);
        if (!empty($data['tags'])){
            $tags = $this->getTags($data);
            $this->urlRepo->createUrlTags($url, $tags);
        }
        return redirect()->route('admin.url.index')
            ->with('msg', __('messages.success', ['action' => 'Create', 'attribute' => 'Shorten URL']))
            ->with('type', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Cập Nhật URL";
        $url = $this->urlRepo->getAllUrls()->find($id);
        $tagIds = $this->urlRepo->getRelatedTags($url);
        $tags = $this->tagRepo->getAllTags()->get();
        $users = $this->userRepo->getAllUsers()->get();
        foreach ($tags as $tag) {
            $urlIds = $this->tagRepo->getRelatedUrls($tag);
            $tag->total_urls = count($urlIds);
            $tags[] = $tag;
        }
        return view('url::edit', compact('tagIds','url', 'tags','title', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UrlRequest $request, $id): RedirectResponse
    {

        $backHalfArr = $this->urlRepo->getBackHalf();
        $data = $request->except('_token', '_method');
        $data['expired_at'] = Carbon::now()->addDays(30)->format('Y-m-d H:i:s');
        if(empty($data['title'])){
            $data['title'] = 'Untitled '.Carbon::now('UTC')->format('Y-m-d H:i:s');
        }
        if(empty($data['back_half'])){
            $data['back_half'] = $this->getBackHalf($backHalfArr);
        }
        $this->urlRepo->update($id, $data);
        if(!empty($data['tags'])){
            $url = $this->urlRepo->find($id);
            $tags = $this->getTags($data);
            $this->urlRepo->updateUrlTags($url, $tags);
        }
        return back()
            ->with('msg', __('messages.success', ['action' => 'Update', 'attribute' => 'Shorten URL']))
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $url = $this->urlRepo->find($id);
        $this->urlRepo->deleteUrlTags($url);
        $this->urlRepo->delete($id);
        return back()->with('msg', __('messages.success', ['action' => 'Delete', 'attribute' => 'Shorten URL']))
            ->with('type', 'success');
    }

    function getBackHalf($backHalfArr)
    {
        $backHalf = $this->faker->regexify('[a-zA-Z0-9]{4,7}');
        $check = in_array($backHalf, $backHalfArr);
        if(!$check) {
            return $backHalf;
        } else {
            $this->getBackHalf($backHalfArr);
        }
    }
    public function getTags ($urlData){
        $tags = [];
        foreach ($urlData['tags'] as $tag) {
            $tags[$tag] = [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }
        return $tags;
    }
}

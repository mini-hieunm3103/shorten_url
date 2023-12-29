<?php

namespace Modules\Url\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Faker\Factory;
use http\Env\Request;
use Illuminate\Http\RedirectResponse;
use Modules\Url\app\Http\Requests\UrlRequest;
use Illuminate\Support\Facades\Redirect;
use Modules\Url\app\Http\Repositories\UrlRepository;
use Modules\Tag\app\Http\Repositories\TagRepository;
use Modules\User\app\Repositories\UserRepository;
use Nwidart\Modules\Facades\Module;
class UrlController extends Controller
{
    protected $urlRepo;
    protected $userRepo;
    protected $tagRepo;
    protected $faker;
    protected $module = 'url';
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
        $module = $this->module;
        checkPermission($this->module);
        $urls = $this->urlRepo->getAllUrls()->get();
        return view('url::index', compact('urls', 'module'));
    }
    public function data($id)
    {
        $url = $this->urlRepo->find($id);
        if (!$url){
            return "Error";
        }
        $tags = $this->tagRepo->getAllTags()->get();
        $tagIds = $this->urlRepo->getRelatedTags($url);
        $relatedTags = [];
        $otherTags = [];
        foreach ($tags as $tag) {
            if (in_array($tag->id, $tagIds)) {
                $relatedTags[] = $tag;
            } else {
                $otherTags[] = $tag;
            }
        }
        $url->tags = $relatedTags;
        $url->other_tags = $otherTags;
        return $url;
    }
    /**
     * Lấy ra thông tin của người dùng cùng với các shorten url của người đó
     */
    public function show($id)
    {
        checkPermission($this->module, 'show');
        $url = $this->urlRepo->find($id);
        check404($url);
        $tags = $this->tagRepo->getAllTags()->get();
        $tagIds = $this->urlRepo->getRelatedTags($url);
        $urlTags = [];
        foreach ($tags as $tag) {
            if(in_array($tag->id, $tagIds)){
                $urlTags[] = $tag;
            }
        }
        return view('url::show', compact( 'urlTags', 'url'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        checkPermission($this->module, 'create');
        $users = $this->userRepo->getAllUsers()->get();
        $tags = $this->tagRepo->getAllTags()->get();
        foreach ($tags as $tag) {
            $urlIds = $this->tagRepo->getRelatedUrls($tag);
            $tag->total_urls = count($urlIds);
        }
        return view('url::create', compact( 'users', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UrlRequest $request)
    {
        checkPermission($this->module, 'create');
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
        // check client or admin create shorten url
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        $routeArr = explode('.', $route);
        if ($routeArr[0] == 'client'){
            return redirect()->route('client.links.index')
                ->with('msg', __('messages.success', ['action' => 'Create', 'attribute' => 'Shorten URL']))
                ->with('type', 'success');
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
        checkPermission($this->module, 'edit');
        $url = $this->urlRepo->getAllUrls()->find($id);
        check404($url);
        $tagIds = $this->urlRepo->getRelatedTags($url);
        $tags = $this->tagRepo->getAllTags()->get();
        $users = $this->userRepo->getAllUsers()->get();
        foreach ($tags as $tag) {
            $urlIds = $this->tagRepo->getRelatedUrls($tag);
            $tag->total_urls = count($urlIds);
        }
        return view('url::edit', compact('tagIds','url', 'tags', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UrlRequest $request, $id): RedirectResponse
    {
        checkPermission($this->module, 'edit');

        $backHalfArr = $this->urlRepo->getBackHalf();
        $data = $request->except('_token', '_method');
        $data['expired_at'] = Carbon::now()->addDays(30)->format('Y-m-d H:i:s');
        if(empty($data['title'])){
            $data['title'] = 'Untitled '.Carbon::now('UTC')->format('Y-m-d H:i:s');
        }
        if(empty($data['back_half'])){
            $data['back_half'] = $this->getBackHalf($backHalfArr);
        }
        if(empty($data['archived'])){
            $data['archived'] = 1;
        }
        $this->urlRepo->update($id, $data);
        $url = $this->urlRepo->find($id);
        if(!empty($data['tags'])){
            $tags = $this->getTags($data);
            $this->urlRepo->updateUrlTags($url, $tags);
        } else {
            $this->urlRepo->deleteUrlTags($url);
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
        checkPermission($this->module, 'delete');

        $url = $this->urlRepo->find($id);
        check404($url);
        $this->urlRepo->deleteUrlTags($url);
        $this->urlRepo->delete($id);

        // check client or admin create shorten url
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        $routeArr = explode('.', $route);
        if ($routeArr[0] == 'client'){
            return \redirect()->back();
        }
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

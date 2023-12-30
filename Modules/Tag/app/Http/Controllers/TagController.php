<?php

namespace Modules\Tag\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Modules\Tag\app\Http\Requests\TagRequest;
use Modules\Tag\app\Http\Repositories\TagRepository;
use Illuminate\Http\Response;
use Modules\Url\app\Http\Repositories\UrlRepository;
use Modules\User\app\Repositories\UserRepository;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $tagRepo;
    protected $userRepo;
    protected $urlRepo;
    protected $module = 'tag';
    public function __construct(
        TagRepository $tagRepo,
        UserRepository $userRepo,
        UrlRepository $urlRepo,
    )
    {
        $this->tagRepo = $tagRepo;
        $this->userRepo = $userRepo;
        $this->urlRepo = $urlRepo;
    }
    public function index()
    {
        checkPermission($this->module);
        $tags = $this->tagRepo->getAllTags()->get();

        foreach ($tags as $tag) {
            $urlIds = $this->tagRepo->getRelatedUrls($tag);
            $tag->total_urls = count($urlIds);
        }
//        dd($tags);
        return view('tag::index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        checkPermission($this->module, 'create');
        $users = $this->userRepo->getAllUsers()->get();
        $urls = $this->urlRepo->getAllUrls()->get();
        return view('tag::create', compact( 'users', 'urls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request): RedirectResponse
    {
        checkPermission($this->module, 'create');
        $tagData = $request->except('_token');
        $tag = $this->tagRepo->create($tagData);
        if (!empty($tagData['urls'])){
            $urls = $this->getUrls($tagData);
            $this->tagRepo->createTagUrls($tag, $urls);
        }
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        $routeArr = explode('.', $route);
        if ($routeArr[0] == 'client'){
            return redirect()->route('client.links.index')
                ->with('msg', __('messages.success', ['action' => 'Create', 'attribute' => 'Shorten URL']))
                ->with('type', 'success');
        }
        return redirect()->route('admin.tag.index')
            ->with('msg', __('messages.success', ['action' => 'Create', 'attribute' => 'Tag']))
            ->with('type', 'success');
    }
    function getUrls($tagData){
        $urls = [];
        foreach ($tagData['urls'] as $url) {
            $urls[$url] = [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }
        return $urls;
    }
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        checkPermission($this->module, 'show');
        $tag = $this->tagRepo->find($id);
        check404($tag);
        $urls = $this->urlRepo->getAllUrls()->get();
        $urlIds = $this->tagRepo->getRelatedUrls($tag);
        $tagUrls = [];
//        dd($urlIds);
        foreach ($urls as $url) {
            if (in_array($url->id, $urlIds)){
                $tagUrls[] = $url;
            }
        }
        return view('tag::show', compact( 'tag', 'tagUrls'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        checkPermission($this->module, 'edit');
        $tag = $this->tagRepo->find($id);
        check404($tag);
        $urlIds = $this->tagRepo->getRelatedUrls($tag);
        $urls = $this->urlRepo->getAllUrls()->get();
        $users = $this->userRepo->getAllUsers()->get();
        return view('tag::edit', compact('urls', 'tag', 'urlIds', 'users' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, $id): RedirectResponse
    {
        checkPermission($this->module, 'edit');
        $tagData = $request->except(['_token', '_method']);
        $this->tagRepo->update($id, $tagData);
        if (!empty($tagData['urls'])){
            $tag = $this->tagRepo->find($id);
            $urls = $this->getUrls($tagData);
            $this->tagRepo->updateTagUrls($tag, $urls);
        }
        return back()
            ->with('msg', __('messages.success', ['action' => 'Update', 'attribute' => 'Tag']))
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        checkPermission($this->module, 'delete');
        $tag = $this->tagRepo->find($id);
        check404($tag);
        $this->tagRepo->deleteTagUrls($tag);
        $this->tagRepo->delete($id);
        return back()
            ->with('msg', __('messages.success', ['action' => 'Delete', 'attribute' => 'Tag']))
            ->with('type', 'success');
    }
}

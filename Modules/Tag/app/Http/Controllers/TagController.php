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
        $title = 'Danh Sách Nhãn Dán';
        $tags = $this->tagRepo->getAllTags()->get();
        return view('tag::index', compact('title', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm Nhãn Dán';
        $users = $this->userRepo->getAllUsers()->get();
        $urls = $this->urlRepo->getAllUrls()->get();
        return view('tag::create', compact('title', 'users', 'urls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request): RedirectResponse
    {
        $tagData = $request->except('_token');
        $tag = $this->tagRepo->create($tagData);
        $urls = $this->getUrls($tagData);
        $this->tagRepo->createTagUrls($tag, $urls);
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
        return view('tag::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Cập Nhật Nhãn Dán';
        $tag = $this->tagRepo->find($id);
        $urlIds = $this->tagRepo->getRelatedUrls($tag);
        $urls = $this->urlRepo->getAllUrls()->get();
        $users = $this->userRepo->getAllUsers()->get();
        return view('tag::edit', compact('title', 'urls', 'tag', 'urlIds', 'users' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, $id): RedirectResponse
    {
        $tagData = $request->except(['_token', '_method']);
        $this->tagRepo->update($id, $tagData);
        $tag = $this->tagRepo->find($id);
        $urls = $this->getUrls($tagData);
        $this->tagRepo->updateTagUrls($tag, $urls);
        return back()
            ->with('msg', __('messages.success', ['action' => 'Update', 'attribute' => 'Tag']))
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}

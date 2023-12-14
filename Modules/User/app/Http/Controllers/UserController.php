<?php

namespace Modules\User\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Url\app\Http\Repositories\UrlRepository;
use Modules\User\app\Http\Requests\UserRequest;
use Modules\User\app\Repositories\UserRepository;
use Modules\Tag\app\Http\Repositories\TagRepository;
class UserController extends Controller
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
        TagRepository $tagRepo
    )
    {
        $this->userRepo = $userRepo;
        $this->urlRepo = $urlRepo;
        $this->tagRepo = $tagRepo;
    }

    public function index()
    {
        $title = 'Danh Sách User';
        $users = $this->userRepo->getAllUsers()->get();
        $urls = $this->urlRepo->getAllUrls()->get();
        $countClicks = [];
        foreach ($users as $key =>$user) {
            $userUrls = $this->urlRepo->getUserUrls($user->id)->get();
            $countUrls = $userUrls->count();
            $countClicks = 0;
            foreach ($userUrls as $url) {
                if ($url->user_id == $user->id) {
                    $countClicks += $url->clicks;
                }
            }
            $user->total_urls = $countUrls;
            $user->total_clicks = $countClicks;
            $users[$key] = $user;
        }
        return view('user::index', compact('users', 'title'));
    }
    /**
     * Lấy ra thông tin của người dùng cùng với các shorten url của người đó
     */
    public function show($id)
    {
        $user = $this->userRepo->find($id);
        $urls = $this->urlRepo->getUserUrls($id)->get();
        $tags = $this->tagRepo->getUserTags($id)->get();
        $countClicks = 0;
        foreach ($urls as $url) {
            $countClicks += $url->clicks;
        }
        $user->count_clicks = $countClicks;
        return view('user::show', compact('user','tags', 'urls'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create User';
        return view('user::create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $this->userRepo->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'group_id' => $request->group_id,
        ]);
        return redirect()->route('admin.user.index')
            ->with('msg',
                __('messages.success',
                    [
                        'action' => 'Create',
                        'attribute' => 'User'
                    ]
                )
            )
            ->with('type', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = $this->userRepo->find($id);
        if(!$user) {
            abort(404);
        }
        $title = 'Update User';
        return view('user::edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id): RedirectResponse
    {
        $data = $request->except('_token', 'password'); // bỏ password bên trong data chứ bên request vẫn còn
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $this->userRepo->update($id, $data);
        return back()
            ->with('msg', __('messages.success', ['action' => 'Update', 'attribute' => 'User']))
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->userRepo->delete($id);
        return back()->with('msg', __('messages.success', ['action' => 'Delete', 'attribute' => 'User']))
            ->with('type', 'success');
    }
}

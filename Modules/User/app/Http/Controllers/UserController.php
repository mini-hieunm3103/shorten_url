<?php

namespace Modules\User\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Modules\Group\app\Http\Repositories\GroupRepository;
use Modules\Url\app\Http\Repositories\UrlRepository;
use Modules\User\app\Http\Requests\UserRequest;
use Modules\User\app\Repositories\UserRepository;
use Modules\Tag\app\Http\Repositories\TagRepository;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userRepo;
    protected $urlRepo;
    protected $tagRepo;
    protected $groupRepo;
    public function __construct
    (
        UserRepository $userRepo,
        UrlRepository $urlRepo,
        TagRepository $tagRepo,
        GroupRepository $groupRepo
    )
    {
        $this->userRepo = $userRepo;
        $this->urlRepo = $urlRepo;
        $this->tagRepo = $tagRepo;
        $this->groupRepo = $groupRepo;
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
        }
        return view('user::index', compact('users', 'title'));
    }
    /**
     * Lấy ra thông tin của người dùng cùng với các shorten url của người đó
     */
    public function show($id)
    {
        $user = $this->userRepo->find($id);
        $title = $user->name;
        $urls = $this->urlRepo->getUserUrls($id)->get();
        $tags = $this->tagRepo->getUserTags($id)->get();
        $countClicks = 0;
        foreach ($urls as $url) {
            $countClicks += $url->clicks;
        }
        $user->count_clicks = $countClicks;
        return view('user::show', compact('title','user','tags', 'urls'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = $this->groupRepo->getAllGroups()->get();
        $title = 'Create User';
        return view('user::create', compact('title', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $group = $this->groupRepo->find($request->group_id);
        $roleGroup = Role::where('roles.id', $group->role_id)->with('permissions')->first();
        $user = $this->userRepo->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'group_id' => $request->group_id,
            'user_id' => Auth::user()->id
        ]);
        $user->assignRole($roleGroup->name);
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
        $groups = $this->groupRepo->getAllGroups()->get();
        $title = 'Update User';
        return view('user::edit', compact('title', 'user', 'groups'));
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
        // sync role
        $user = $this->userRepo->find($id);
        $group = $this->groupRepo->find($request->group_id);
        $roleGroup = Role::where('roles.id', $group->role_id)->with('permissions')->first();

        $this->userRepo->update($id, $data);
        $user->syncRoles($roleGroup->name);
        return back()
            ->with('msg', __('messages.success', ['action' => 'Update', 'attribute' => 'User']))
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = $this->userRepo->find($id);
        $group = $this->groupRepo->find($user->group_id);
        $roleGroup = Role::where('roles.id', $group->role_id)->with('permissions')->first();

        $this->userRepo->delete($id);
        // remove role
        $user->removeRole($roleGroup->name);
        return back()->with('msg', __('messages.success', ['action' => 'Delete', 'attribute' => 'User']))
            ->with('type', 'success');
    }
}

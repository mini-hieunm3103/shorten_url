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
    protected $module = 'user';
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
        checkPermission($this->module);
        $users = $this->userRepo->getAllUsers()->get();
        foreach ($users as $user) {
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
        return view('user::index', compact('users'));
    }
    /**
     * Lấy ra thông tin của người dùng cùng với các shorten url của người đó
     */
    public function show($id)
    {
        checkPermission($this->module, 'show');
        $user = $this->userRepo->find($id);
        check404($user);
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
        checkPermission($this->module, 'create');
        $groups = $this->groupRepo->getAllGroups()->get();
        return view('user::create', compact( 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        checkPermission($this->module, 'create');
        $group = $this->groupRepo->find($request->group_id);
        check404($group);
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
        checkPermission($this->module, 'edit');
        $user = $this->userRepo->find($id);
        check404($user);
        $groups = $this->groupRepo->getAllGroups()->get();
        return view('user::edit', compact( 'user', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id): RedirectResponse
    {
        checkPermission($this->module, 'edit');
        $data = $request->except('_token', 'password'); // bỏ password bên trong data chứ bên request vẫn còn
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        // sync role
        $user = $this->userRepo->find($id);
        check404($user);
        $group = $this->groupRepo->find($request->group_id);
        check404($group);
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
        checkPermission($this->module, 'delete');
        $user = $this->userRepo->find($id);
        check404($user);
        $group = $this->groupRepo->find($user->group_id);
        $roleGroup = Role::where('roles.id', $group->role_id)->with('permissions')->first();
        $this->userRepo->delete($id);
        // remove role
        $user->removeRole($roleGroup->name);
        return back()->with('msg', __('messages.success', ['action' => 'Delete', 'attribute' => 'User']))
            ->with('type', 'success');
    }
}

<?php

namespace Modules\Group\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Modules\Group\app\Http\Requests\GroupRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Group\app\Http\Repositories\GroupRepository;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $groupRepo;
    protected $module = 'group';

    public function __construct(GroupRepository $groupRepo)
    {
        $this->groupRepo = $groupRepo;
    }

    public function index()
    {
        checkPermission($this->module);
        $groups = $this->groupRepo->getAllGroups()->get();
        return view('group::index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        checkPermission($this->module, 'create');
        return view('group::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request): RedirectResponse
    {
        checkPermission($this->module, 'create');
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        $roleGroup = Role::create(['name' => Str::slug($data['name'], '_')]);
        $data['role_id'] = $roleGroup->id;
        $this->groupRepo->create($data);
        return redirect()->route('admin.group.index')
            ->with('msg',
                __('messages.success',
                    [
                        'action' => 'Create',
                        'attribute' => 'Group'
                    ]
                )
            )
            ->with('type', 'success');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        checkPermission($this->module, 'show');
        $group = $this->groupRepo->find($id);
        check404($group);
        $users = $this->groupRepo->getRelatedUsers($group);
//        dd($users);
        return view('group::show', compact('users', 'group'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        checkPermission($this->module, 'edit');
        $group = $this->groupRepo->find($id);
        check404($group);
        return view('group::edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, $id): RedirectResponse
    {
        checkPermission($this->module, 'edit');
        $data = $request->except(['_token', '_method']);
        $this->groupRepo->update($id, $data);
        return back()
            ->with('msg', __('messages.success', ['action' => 'Update', 'attribute' => 'Group']))
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        checkPermission($this->module, 'delete');
        $group = $this->groupRepo->find($id);
        check404($group);
        $usersCount = count($this->groupRepo->getRelatedUsers($group));
        if ($usersCount == 0) {
            $this->groupRepo->delete($id);
            Role::findById($group->role_id)->delete();
            return redirect()->route('admin.group.index')
                ->with('msg', __('messages.success', ['action' => 'Delete', 'attribute' => 'Group']))
                ->with('type', 'success');
        }
        return redirect()->route('admin.group.index')
            ->with('msg', 'Bạn Không Thể Xóa Nhóm Do Trong Nhóm Đang Có '.$usersCount.' Người Dùng!')
            ->with('type', 'danger');
    }
    public function getPermissionForm($id)
    {
        checkPermission($this->module, 'permission');
        $group = $this->groupRepo->find($id);
        check404($group);
        $permissionsGroup = Role::where('roles.id', $group->role_id)->with('permissions')->first()->permissions;
        $permissionIdsArr = [];
        foreach ($permissionsGroup as $permission) {
            $permissionIdsArr[] = $permission->id;
        }
        $modules = Module::all();
        return view('group::permission', compact('group', 'modules', 'permissionIdsArr'));
    }

    /**
     * @param $id
     * Note: syncPermissions(['name' => 'view users'])
     */
    public function permissionHandle(Request $request, $id)
    {
        checkPermission($this->module, 'permission');

        $group = $this->groupRepo->find($id);
        check404($group);
        $request->validate([
            'permissions' => 'required'
        ], [
            'permissions.required' => 'Permissions Is Required!'
        ]);
        $permissionsSync = $request->permissions;
        $roleGroup = Role::where('roles.id', $group->role_id)->with('permissions')->first();
        $roleGroup->syncPermissions($permissionsSync);
        return back()
            ->with('msg', __('messages.success', ['action' => 'Permissions', 'attribute' => 'Group']))
            ->with('type', 'success');
    }
}

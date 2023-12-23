<?php

namespace Modules\Group\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\RedirectResponse;
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
    public function __construct(GroupRepository $groupRepo)
    {
        $this->groupRepo = $groupRepo;
    }

    public function index()
    {
        $groups = $this->groupRepo->getAllGroups()->get();
        return view('group::index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('group::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request): RedirectResponse
    {
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
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
        $group = $this->groupRepo->find($id);
        $users = $this->groupRepo->getRelatedUsers($group);
//        dd($users);
        return view('group::show', compact('users', 'group'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $group = $this->groupRepo->find($id);
        return view('group::edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, $id): RedirectResponse
    {
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
        $group = $this->groupRepo->find($id);
        $usersCount = count($this->groupRepo->getRelatedUsers($group));
        if ($usersCount == 0) {
            $this->groupRepo->delete($id);
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
        $group = $this->groupRepo->find($id);
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
        $group = $this->groupRepo->find($id);

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

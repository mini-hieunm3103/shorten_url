<?php
// tối ưu Repository design pattern
namespace Modules\Group\app\Http\Repositories;

use Illuminate\Support\Facades\Hash;
use Modules\Group\app\Models\Group;
use Modules\User\app\Models\User;
use App\Repositories\BaseRepository;
use Modules\Group\app\Http\Repositories\GroupRepositoryInterface;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{
    public function getModel()
    {
        return Group::class;
    }

    public function getAllGroups(){
        return $this->model->select(['id','name','user_id', 'created_at']);
    }
    public function getRelatedUsers($user){
        return $user->group;
    }
}

<?php
// tối ưu Repository design pattern
namespace Modules\Group\app\Http\Repositories;

use App\Repositories\RepositoryInterface;

interface GroupRepositoryInterface extends RepositoryInterface
{
    //Lấy danh sách người dùng
    public function getAllGroups();
    public function getRelatedUsers($group);
}

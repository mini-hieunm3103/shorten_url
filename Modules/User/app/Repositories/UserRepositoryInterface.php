<?php
// tối ưu Repository design pattern
namespace Modules\User\app\Repositories;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    //Lấy danh sách người dùng
    public function getUsers($limit);
    public function setPassword($password, $user_id);
    public function checkPassword($password, $user_id);
}

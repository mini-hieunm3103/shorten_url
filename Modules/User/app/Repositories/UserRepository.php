<?php
// tối ưu Repository design pattern
namespace Modules\User\app\Repositories;

use Illuminate\Support\Facades\Hash;
use Modules\User\app\Models\User;
use App\Repositories\BaseRepository;
use Modules\User\app\Repositories\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getUsers($limit=10)
    {
        return $this->model->paginate($limit);
    }
    public function getAllUsers(){
        return $this->model->select(['id','name', 'email', 'created_at']);
    }
    public function setPassword($password, $user_id){
        return $this->update($user_id, ['password' => Hash::make($password)]);
    }
    public function checkPassword($password, $user_id)
    {
        $user = $this->find($user_id);
        if($user){
            $hashPassword = $user->password;
            return Hash::check($password, $hashPassword);
        }
        return false;
    }
}

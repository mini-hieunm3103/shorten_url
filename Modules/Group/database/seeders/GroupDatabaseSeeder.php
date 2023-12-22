<?php

namespace Modules\Group\database\seeders;

use App\Models\PermissionModel;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\User\app\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GroupDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modules')->insert([
            'name' => 'group',
            'title' => 'Nhóm',
            'icon' => 'users',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('modules')->insert([
            'name' => 'user',
            'title' => 'Người Dùng',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('modules')->insert([
            'name' => 'tag',
            'title' => 'Nhãn Dán',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('modules')->insert([
            'name' => 'url',
            'title' => 'URL Rút Gọn',
            'icon' => 'link',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $faker = Factory::create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $groupId = DB::table('groups')->insertGetId(
            [
                'name'=>'Super Administrator',
                'user_id'=>0,
                'role_id' =>0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]
        );
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        if ($groupId>0){
            $userId = DB::table('users')->insertGetId([
                'name'=>'Nguyễn Minh Hiếu',
                'email'=>'hieunm3103@gmail.com',
                'password'=>Hash::make('12345678'),
                'group_id'=>$groupId,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]);
            if ($userId>0){
                for ($i = 0; $i < 5; $i++) {
                    DB::table('tags')->insert([
                        'title' => $faker->text(30),
                        'description' => $faker->sentence(),
                        'user_id' =>  $userId,
                        'created_at' => $faker->dateTimeThisYear('now', 'Asia/Ho_Chi_Minh'),
                        'updated_at' => $faker->dateTimeThisYear('now', 'Asia/Ho_Chi_Minh'),
                    ]);
                    DB::table('urls')->insert([
                        'title' => 'Untitled '. Carbon::now('UTC')->format('Y-m-d H:i:s').' UTC',
                        'long_url' => $faker->url(),
                        'back_half' => $faker->regexify('[a-zA-Z0-9]{3,5}'),
                        'clicks' => 0,
                        'user_id' => $userId,
                        'created_at' => $faker->dateTimeThisYear('now', 'Asia/Ho_Chi_Minh'),
                        'updated_at' => $faker->dateTimeThisYear('now', 'Asia/Ho_Chi_Minh'),
                        'expired_at' => Carbon::now()->addDays(30),
                    ]);
                }
                // Seeding Role => group
                $group = DB::table('groups')->first();
                // do ở route sẽ sử dụng middleware dạng role:role_name
                Role::create(['name' => str_replace(' ', '_', strtolower(trim($group->name)))]);
                // Sửa role_id của super admin:
                DB::table('groups')->where('id', $groupId)->update(['role_id' => 1]);
                // Seeding Permission => module
                $superAdminRole = Role::first();
                $modules = DB::table('modules')->get();
                $actionArr = ['view', 'show', 'create', 'edit', 'delete'];

                foreach ($modules as $module) {
                    for ($i = 0; $i < count($actionArr); $i++) {
                        if ($actionArr[$i] == 'view'){
                            // chú ý: ở đây là `view users` not `view user`
                            $permission = ['name' => $actionArr[$i].' '.$module->name.'s', 'module_id' => $module->id];
                        } else {
                            $permission = ['name' => $actionArr[$i].' '.$module->name, 'module_id' => $module->id];
                        }
                        // tạo quyền cơ bản
                        PermissionModel::createWithModuleId($permission);
                        // gán quyền cho role super admin
                        $superAdminRole->givePermissionTo($permission);
                    }
                    if ($module->name == 'group'){
                        Permission::create(['name' => 'permission group', 'module_id'=>$module->id]);
                    }
                }
                // tạo quyền phân quyền cho super admin

                $superAdminRole->givePermissionTo(['name' => 'permission group']);
                // gán vai trò cho user này
                User::find($userId)->assignRole('super_administrator');
                // tạo sẵn 2 group
                $adminRole = Role::create(['name' => 'administrator']);
                DB::table('groups')->insert([
                    'name'=>'Administrator',
                    'user_id'=> $userId,
                    'role_id' => $adminRole->id,
                    'created_at'=> date('Y-m-d H:i:s'),
                    'updated_at'=> date('Y-m-d H:i:s'),
                ]);
                $userRole = Role::create(['name' => 'user']);
                DB::table('groups')->insert([
                    'name'=>'User',
                    'user_id'=> $userId,
                    'role_id' => $userRole->id,
                    'created_at'=> date('Y-m-d H:i:s'),
                    'updated_at'=> date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}

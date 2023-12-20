<?php

namespace Modules\Group\database\seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;
class GroupDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $groupId = DB::table('groups')->insertGetId(
            [
                'name'=>'Super Administrator',
                'user_id'=>0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]
        );
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        if ($groupId>0){
            $userId = DB::table('users')->insertGetId([
                'name'=>'Nguyễn Minh Hiếu',
                'email'=>'hieunm3103@gmail.com',
                'password'=>Hash::make('111111'),
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
            }
        }
    }
}

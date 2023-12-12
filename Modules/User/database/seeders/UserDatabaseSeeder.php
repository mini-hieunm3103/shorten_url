<?php

namespace Modules\User\database\seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $count = DB::table('users')->count();
        if ($count < 3) {
            DB::table('users')->insert([
                'name' => 'Nguyễn Minh Hiếu',
                'email' => 'hieunm3103@gmail.com',
                'password' => Hash::make('111111'),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
            for ($i = 0; $i < 20; $i++) {
                DB::table('users')->insert([
                    'name' => $faker->name(),
                    'email' => $faker->safeEmail(),
                    'password' => Hash::make('11111'),
                    'created_at' => $faker->dateTime(),
                    'updated_at' => $faker->dateTime()
                ]);
            }
        }
    }
}

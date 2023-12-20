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
            for ($i = 0; $i < 20; $i++) {
                DB::table('users')->insert([
                    'name' => $faker->name(),
                    'email' => $faker->safeEmail(),
                    'password' => Hash::make('11111'),
                    'group_id' => 2,
                    'created_at' => $faker->dateTime(),
                    'updated_at' => $faker->dateTime()
                ]);
            }
        }
    }
}

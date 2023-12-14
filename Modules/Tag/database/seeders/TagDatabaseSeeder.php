<?php

namespace Modules\Tag\database\seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $count = DB::table('tags')->count();
        if ($count < 3) {
            for ($i = 0; $i < 20; $i++) {
                DB::table('tags')->insert([
                    'title' => $faker->text(30),
                    'description' => $faker->sentence(),
                    'user_id' => rand(1,3),
                    'created_at' => $faker->dateTimeThisYear('now', 'Asia/Ho_Chi_Minh'),
                    'updated_at' => $faker->dateTimeThisYear('now', 'Asia/Ho_Chi_Minh'),
                ]);
            }
        }
    }
}

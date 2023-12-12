<?php

namespace Modules\Url\database\seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class UrlDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $count = DB::table('urls')->count();
        if ($count < 3) {
            for ($i = 0; $i < 20; $i++) {
                DB::table('urls')->insert([
                    'title' => 'Untitled '. Carbon::now('UTC')->format('Y-m-d H:i:s').' UTC',
                    'long_url' => $faker->url(),
                    'back_half' => $faker->regexify('[a-zA-Z0-9]{3,5}'),
                    'clicks' => 0,
                    'user_id' => rand(1,3),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'expired_at' => Carbon::now()->addDays(30),
                ]);
            }
        }
    }
}

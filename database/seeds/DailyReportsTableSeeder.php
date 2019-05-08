<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DailyReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daily_reports')->truncate();
        $faker = Faker::create('en_US');
        for ($i = 0; $i < 10; $i++) { 
            DB::table('daily_reports')->insert([
                'user_id' => $i,
                'title' => $faker->sentence(),
                'contents' => $faker->text(),
                'reporting_time' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}

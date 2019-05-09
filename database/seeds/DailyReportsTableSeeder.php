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
        $tableName = 'daily_reports';
        DB::table($tableName)->truncate();
        // 手書きのテスト用シード
        DB::table($tableName)->insert([
            'user_id' => 1,
            'title' => '日報テスト',
            'contents' => 'これは日報です',
            'reporting_time' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // 自動生成シード
        $faker = Faker::create('en_US');
        for ($i = 0; $i < 10; $i++) { 
            DB::table($tableName)->insert([
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

<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('questions')->truncate();
        factory(App\Models\Question::class, 20)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

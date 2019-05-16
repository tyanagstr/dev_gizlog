<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('comments')->truncate();
        factory(App\Models\Comment::class, 20)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

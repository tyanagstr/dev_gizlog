<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');         // 日報の投稿者
            $table->string('title');            // 日報のタイトル
            $table->text('contents');           // 日報の内容
            $table->datetime('reporting_time'); // 日報の日付
            $table->timestamps();               // created_at / updated_at 
                                                // 作成日時 / 更新日時
            $table->softDeletes();              // deleted_at 削除日時
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            $table->dropIfExists();
        });
    }
}

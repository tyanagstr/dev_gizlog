<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    // 取得時Carbonでラップするカラムを指定
    protected $dates = ['reporting_time'];   

    // fillでモデルにセットするカラムを指定
    protected $fillable = [ 
        'title',
        'contents',
        'reporting_time'
    ];
}

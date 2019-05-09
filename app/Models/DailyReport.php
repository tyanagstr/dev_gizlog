<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;

    // 取得時Carbonでラップするカラムを指定
    protected $dates = ['reporting_time', 'deleted_at'];   

    // fillでモデルにセットするカラムを指定
    protected $fillable = [ 
        'user_id',
        'title',
        'contents',
        'reporting_time'
    ];
}

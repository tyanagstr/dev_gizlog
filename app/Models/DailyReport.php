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

    // relations
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * ユーザーのすべての日報を取得
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection 指定ユーザーの全日報を格納したモデルの配列
     */
    public function fetchAllUserReportsOfUser($id)
    {
        return $this->where('user_id', $id)
                    ->orderby('reporting_time', 'DEC')
                    ->get();
    }

    /**
     * 年月に合致するユーザーの日報を取得
     * @param int $id 指定するユーザーのID
     * @return \Illuminate\Database\Eloquent\Collection 年月に合致するユーザーの全日報
     */
    public function fetchUserReportsFilterdByDate($id, $date)
    {
        return $this->where('user_id', $id)
                    ->whereYear('reporting_time', $date->year)
                    ->whereMonth('reporting_time', $date->month)
                    ->orderby('reporting_time', 'DEC')
                    ->get();
    }
}

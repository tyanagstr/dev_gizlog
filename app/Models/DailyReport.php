<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    protected $fillable = [ 
        'title',
        'contents',
        'reporting_time'
    ];
}

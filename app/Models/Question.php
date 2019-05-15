<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $dates = [
        'updated_at',
        'deleted_at'
    ];
    
    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content'
    ];
    
    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function tagCategory()
    {
        $this->belongsTo(TagCategory::class);
    }
}

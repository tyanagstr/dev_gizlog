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
    
    // relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tagCategory()
    {
        return $this->belongsTo(TagCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function fetchByCategoryId($category_id)
    {
        return $this->where('tag_category_id', $category_id)
                    ->get();        
    }
}

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

    // scopes
    public function scopeWithComments($query)
    {
        return $query->with('comments.user');
    }

    public function scopeWithCommentCount($query)
    {
        return $query->withCount('comments');
    }

    public function scopeWithTagCategory($query)
    {
        return $query->with('tagCategory:id,name');
    }

    public function scopeWithUser($query)
    {
        return $query->with('user:id,name,avatar');
    }

    // fetch methods
    /**
     * IDに対応する質問と付随する情報を取得する
     */
    public function fetchById($id) {
        return $this->withUser()
                    ->withComments()
                    ->withTagCategory()
                    ->findOrFail($id);
    }

    /**
     * 一覧表示用の全件取得する
     */
    public function fetchAll()
    {
        return $this->withTagCategory()
                    ->withCommentCount()
                    ->orderBy('updated_at', 'DSC')
                    ->get();
    }

    /**
     * カテゴリのIDを指定して取得する
     */
    public function fetchByCategoryId($category_id)
    {
        return $this->withTagCategory()
                    ->withCommentCount()
                    ->where('tag_category_id', $category_id)
                    ->orderBy('updated_at', 'DSC')
                    ->get();        
    }

    /**
     * キーワードによる検索結果を取得する
     */
    public function fetchBySearchWord($search_word)
    {
        return $this->withTagCategory()
                    ->withCommentCount()
                    ->join('tag_categories', 'tag_categories.id', '=', 'questions.tag_category_id')
                    ->where('questions.title', 'like', "%$search_word%")
                    ->orWhere('tag_categories.name', $search_word)
                    ->orderBy('updated_at', 'DSC')
                    ->get();        
    }

    /**
     * ユーザーの投稿した質問を取得する
     */
    public function fetchByUserId($user_id)
    {
        return $this->withCommentCount()
                    ->withTagCategory()
                    ->where('user_id', $user_id)
                    ->get();
    }
}

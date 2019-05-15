<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    protected $comment;

    public function __construct(Comment $comment) {
        $this->comment = $comment;
    }
}

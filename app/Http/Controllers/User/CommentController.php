<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Http\Requests\User\CommentRequest;

class CommentController extends Controller
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * コメントを追加する.
     * @param \App\Http\Requests\User\CommentRequest $request
     */
    public function store(CommentRequest $request)
    {
        $this->comment->fill($request->all())->save();
        return redirect()->route('question.show', $request->input('question_id'));
    }
}

<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\TagCategory;
use App\Http\Requests\User\QuestionsRequest;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    protected $question;
    protected $category;

    public function __construct(Question $question, TagCategory $category)
    {
        $this->question = $question;
        $this->category = $category;
    }

    /**
     * 質問一覧画面を表示
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category_id = $request->query('tag_category_id');
        $search_word = $request->query('search_word');
        $questions = NULL;
        if(empty($category_id) && empty($search_word)) {
            $questions = $this->question->fetchAll();
        } else {
            if (!empty($category_id)) {
                //カテゴリによるフィルタ
                $questions = $this->question->fetchByCategoryId($category_id);
            } else if (!empty($search_word)) {
                $questions = $this->question->fetchBySearchWord($search_word);
            }
        }
        $categories = $this->category->all();
        return view('user.question.index', compact('categories', 'questions'));
    }

    /**
     * 質問作成画面の表示をする
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->all()->pluck('name', 'id');
        return view('user.question.create', compact('categories'));
    }

    /**
     * 質問の投稿をする
     *
     * @param  \App\Http\Requests\User\QuestionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $request)
    {
        $this->question->fill($request->all())->save();
        return redirect()->route('question.index'); 
    }

    /**
     * 質問の詳細を表示する
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->fetchById($id);
        
        return view('user.question.show', compact('question'));
    }

    /**
     * ユーザーのマイページを表示
     */
    public function showMypage()
    {
        $questions = $this->question->fetchByUserId(Auth::id());
        $user = Auth::user();
        return view('user.question.mypage', compact(['questions', 'user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

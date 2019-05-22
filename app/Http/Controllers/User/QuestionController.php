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

        $categories = $this->category->all();
        $is_category_id_empty = empty($category_id);
        $is_search_word_empty = empty($search_word);

        if ($is_category_id_empty && $is_search_word_empty) {
            $questions = $this->question->fetchAllQuestions();
            return view('user.question.index', compact('categories', 'questions'));
        }

        if (!$is_category_id_empty && !$is_search_word_empty) {
            // カテゴリとキーワードによるフィルタ
            $questions = $this->question->fetchByCategoryAndWord($category_id, $search_word);
            return view('user.question.index', compact('categories', 'questions'));
        } elseif (!$is_category_id_empty) {
            //カテゴリによるフィルタ
            $questions = $this->question->fetchByCategoryId($category_id);
            return view('user.question.index', compact('categories', 'questions'));
        } elseif (!$is_search_word_empty) {
            // キーワードで検索
            $questions = $this->question->fetchBySearchWord($search_word);
            return view('user.question.index', compact('categories', 'questions'));
        }
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
     * 質問編集画面を表示
     *
     * @param int $id 質問のID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->question->findOrFail($id);
        $categories = $this->category->all()->pluck('name', 'id');
        return view('user.question.edit', compact('question', 'categories'));
    }

    /**
     * 質問を更新する
     *
     * @param  \App\Http\Requests\User\QuestionsRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsRequest $request, $id)
    {
        $this->question->findOrFail($id)->fill($request->all())->save();
        return redirect()->route('question.mypage');
    }

    /**
     * 質問を削除する
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->destroy($id);
        return redirect()->route('question.mypage');
    }
}

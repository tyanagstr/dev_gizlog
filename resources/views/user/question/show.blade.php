@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問詳細</h1>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      <img src="{{ $question->user->avatar }}" class="avatar-img">
      <p>{{ $question->user->name }}さんの質問&nbsp;&nbsp;({{ $question->tagCategory->name }})</p>
      <p class="question-date"></p>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $question->title }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{{ $question->content }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    <div class="comment-list">
      @foreach ($question->comments as $comment)
        <div class="comment-wrap">
          <div class="comment-title">
            <img src="{{ $comment->user->avatar }}" class="avatar-img">
            <p>{{ $comment->user->name }}</p>
            <p class="comment-date">{{ $comment->created_at }}</p>
          </div>
          <div class="comment-body">{{ $comment->comment }}</div>
        </div>
      @endforeach
    </div>
  <div class="comment-box">
    {!! Form::open(['route' => 'question.comment.add', 'method' => 'post']) !!}
      {!! Form::hidden('user_id', Auth::id()) !!}
      {!! Form::hidden('question_id', $question->id) !!}
      <div class="comment-title">
        <img src="{{ Auth::user()->avatar }}" class="avatar-img"><p>コメントを投稿する</p>
      </div>
      <div class="comment-body {{ $errors->has('comment') ? 'has-error' : '' }}">
        {!! Form::textarea('comment', old('comment'), [
          'class' => 'form-control',
          'placeholder' => 'Add your comment...', 
          'cols' => 50,
          'rows' => 10, 
        ]) !!}
        <span class="help-block">{{ $errors->first('comment') }}</span>
      </div>
      <div class="comment-bottom">
        {!! Form::button('<i class="fa fa-pencil" aria-hidden="true"></i>', [
          'type' => 'submit',
          'class' => 'btn btn-success',
        ]) !!}
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection

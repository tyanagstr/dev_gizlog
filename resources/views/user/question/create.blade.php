@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.store', 'method' => 'post']) !!}
      <div class="form-group">
        {!! Form::hidden('user_id', Auth::id()) !!}
        {!! Form::select('tag_category_id', $categories, old('categories'), [
          'placeholder' => 'Select category',
          'class' => "form-control selectpicker form-size-small",
          'id' => 'pref_id']) !!}
        <span class="help-block {{ $errors->has('tag_category_id') ? 'has-error': '' }}">{{ $errors->first('tag_category_id') }}</span>
      </div>
      <div class="form-group">
        {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block {{ $errors->has('title') ? 'has-error': '' }}">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group">
        {!! Form::textarea('content', old('content'), [
          'class' => 'form-control', 
          'placeholder' => 'Please write down your question here...',
          'cols' => '50',
          'rows' => '10']) !!}
        <span class="help-block {{ $errors->has('content') ? 'has-error': '' }}">{{ $errors->first('content') }}</span>
      </div>
      {!! Form::submit('create', ['name' => 'confirm', 'class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection


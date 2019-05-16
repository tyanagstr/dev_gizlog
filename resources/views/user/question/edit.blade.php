@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問編集</h1>

<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['question.update', $question->id], 'method' => 'put']) !!}
      <div class="form-group {{ $errors->has('tag_category_id') ? 'has-error' : '' }}">
        {!! Form::select('tag_category_id', $categories, old('tag_category_id') ?: $question->tag_category_id, [
          'placeholder' => 'Select category',
          'class' => 'form-control selectpicker form-size-small', 
          'id' => 'pref_id' 
        ]) !!}
        <span class="help-block">{{ $errors->first('tag_category_id')}}</span>
      </div>
      <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
        {!! Form::text('title', old('title') ?: $question->title, ['class' => 'form-control']) !!}
        <span class="help-block">{{ $errors->first('title')}}</span>
      </div>
      <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
        {!! Form::textarea('content', old('content') ?: $question->content, [
          'class' => 'form-control', 
          'placeholder' => 'Please write down your question here...',  
          'cols' => 50,
          'rows' => 10
        ]) !!}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {!! Form::submit('update', ['class' => 'btn btn-success pull-right', 'name' => 'confirm']) !!}
    </form>
  </div>
</div>

@endsection


@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'report.store']) !!}
      {!! Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control']) !!}
      <div class="form-group form-size-small {{ $errors->has('reporting_time')? 'has-error' : ''}}">
        {!! Form::date('reporting_time', Carbon::now(), ['class' => 'form-control']) !!}
        <span class="help-block">{{ $errors->first('reporting_time') }}</span>
      </div>
      <div class="form-group {{ $errors->has('title')? 'has-error' : ''}}">
        {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group {{ $errors->has('contents')? 'has-error' : ''}}">
        {!! Form::textarea('contents', '', [
          'class' => 'form-control',
          'placeholder' => 'Content',
          'cols' => '50',
          'rows' => '10'
        ]) !!}
        <span class="help-block">{{ $errors->first('contents') }}</span>
      </div>
      {!! Form::submit('Add', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection


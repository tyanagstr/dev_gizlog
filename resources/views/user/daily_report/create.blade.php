@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  {!! Form::open(['route' => 'daily_report.store', 'class' => 'container form']) !!}
    {!! Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control']) !!}
    <div class="form-group form-size-small">
      {!! Form::date('reporting_time', null, ['class' => 'form-control']) !!}
      <span class="help-block">{{ $errors->first('reporting_time') }}</span>
    </div>
    <div class="form-group">
      {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) !!}
      <span class="help-block">{{ $errors->first('title') }}</span>
    </div>
    <div class="form-group">
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

@endsection


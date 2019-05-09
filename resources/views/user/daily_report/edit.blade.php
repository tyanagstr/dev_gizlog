@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['report.update', $report->id], 'method' => 'PUT']) !!}
      {!! Form::hidden('user_id', $report->user_id, ['class' => 'form-control']) !!}
      <div class="form-group form-size-small {{ $errors->has('reporting_time')? 'has-error' : '' }}">
        {!! Form::date('reporting_time', $report->reporting_time, ['class' => 'form-control']) !!}
      <span class="help-block">{{ $errors->first('reporting_time') }}</span>
      </div>
      <div class="form-group {{ $errors->has('title')? 'has-error' : '' }}">
        {!! Form::text('title', $report->title, [
          'class' => 'form-control',
          'placeholder' => 'Title'
        ]) !!}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group {{ $errors->has('contents')? 'has-error' : '' }}">
        {!! Form::textarea('contents', $report->contents, [
          'class' => 'form-control',
          'placeholder' => '本文',
          'cols' => '50',
          'rows' => '10'
        ]) !!}
      <span class="help-block">{{ $errors->first('contents') }}</span>
      </div>
      {!! Form::submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection


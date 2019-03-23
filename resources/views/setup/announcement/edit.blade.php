@extends('layouts.app') 
@section('content') {{-- <a class="btn btn-outline-secondary" href="{{ URL::previous() }}" role="button">Back</a>--}}

<h2>Edit Announcement</h2>

<hr/> {!! Form::open(['action' => ['AnnouncementsController@update', $announcement], 'method' => 'POST']) !!}
<div class="form-group">
    {{Form::label('message', 'Message')}} {{Form::textarea('message', old("message") ? old("message") : (!empty($announcement)
    ? $announcement->message : null), ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
</div>
{{Form::hidden('_method', 'PUT')}} {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} {!! Form::close() !!}
@endsection
@extends('layouts.master')

@section('title', 'Manage Written Exam')

@section('content')

@push('css')
<link rel="stylesheet" href="{{ asset('css/manage-exam-questions.css') }}" />
@endpush

@include('blocks.profile-navbar')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
             <a href="{{ route('written.questions.create') }}" class="btn btn-info btn-block"><i class="fa fa-plus fa-fw"></i> Create new question</a>
            <div class="panel panel-default" style="margin-top:20px;">
                <!-- List group -->
                <ul class="list-group">
                    @if(!empty($questions))
                        @foreach($questions AS $i => $q)
                            <li class="list-group-item {{ Route::input('id') == $q['id'] ? 'active' : '' }}">
                                <a href=" {{ route('written.questions.update', ['id' => $q['id']]) }} "><i class="fa fa-pencil fa-fw"></i> Question # {{ $i+1 }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
             <a href="{{ route('profile') }}" class="btn btn-link btn-block"><i class="fa fa-chevron-left"></i> Go back to profile</a>
            
        </div>
        <div class="col-sm-9">
            {!! Form::open(['method' => 'post', 'url' => $action, 'class' => 'common']) !!}
                 <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="page-header text-center" style="margin-top:0">
                            <h2>{{ $title }}</h2>
                        </div>
                        <div class="form-group">
                            {!! Form::label('body', 'Question body', ['class' => 'control-label']) !!}
                            {!! Form::textarea('body', $question->body, ['class' => 'form-control']) !!}
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::bsText('limit', $question->limit, 'Time limit (minutes)') !!}
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                    
                 </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
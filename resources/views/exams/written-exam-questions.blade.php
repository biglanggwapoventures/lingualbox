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
                <div class="list-group">
                    @if(!empty($questions))
                        @foreach($questions AS $i => $q)
                            <a class="list-group-item {{ Route::input('id') == $q['id'] ? 'active' : '' }}" href=" {{ route('written.questions.update', ['id' => $q['id']]) }} "><i class="fa fa-pencil fa-fw"></i> Question # {{ $i+1 }}</a>
                        @endforeach
                    @endif
                </div>
            </div>
             <a href="{{ route('profile') }}" class="btn btn-link btn-block"><i class="fa fa-chevron-left"></i> Go back to profile</a>
            
        </div>
        <div class="col-sm-9">
            {!! Form::open(['method' => 'post', 'url' => $action, 'class' => 'common']) !!}
                 <div class="panel panel-default clearfix">
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
                        @if(isset($question->id))
                            <button data-toggle="modal" data-target="#myModal" class="btn btn-danger pull-right" type="button">Delete</button>
                        @endif
                    </div>
                    
                 </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
 @if(isset($question->id))
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            {!! Form::open(['url' => route('written.questions.delete'), 'method' => 'DELETE', 'class' => 'common' ]) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! Form::hidden('id', $question->id) !!}
                    <h4 class="modal-title">Confirm deletion</h4>
                </div>
                <div class="modal-body">
                    <p class="lead text-center text-danger">Are you sure you want to delete this?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
 @endif
@endsection
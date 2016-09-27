@extends('layouts.master')

@section('title', 'Manage Reading Exam')

@section('content')

@push('css')
<link rel="stylesheet" href="{{ asset('css/manage-exam-questions.css') }}" />
@endpush

@include('blocks.profile-navbar')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <a href="{{ route('reading.questions.create') }}" class="btn btn-info btn-block"><i class="fa fa-plus fa-fw"></i> Create new question</a>
            <div class="panel panel-default" style="margin-top:20px;">
                <!-- List group -->
                <div class="list-group">
                    <a class="list-group-item {{  Route::currentRouteNamed('reading.storyboard.edit') ? 'active' : ''}}" href="{{ route('reading.storyboard.edit') }}"><i class="fa fa-book fa-fw"></i> Storyboard</a>
                    @if(!empty($questions))
                        @foreach($questions AS $key => $row)
                            <a class="list-group-item  {{  Route::currentRouteNamed('reading.questions.edit') && Route::input('id') == $row['id'] ? 'active' : ''}}" href="{{ route('reading.questions.edit', ['id' => $row['id']]) }}"><i class="fa fa-pencil fa-fw"></i> Question # {{ $key+1 }}</a>
                        @endforeach
                    @endif
                </div>
            </div>
            <a href="{{ route('profile') }}" class="btn btn-link btn-block"><i class="fa fa-chevron-left"></i> Go back to profile</a>
            
        </div>
        <div class="col-sm-9">
           @yield('form')
        </div>
    </div>
</div>
@endsection
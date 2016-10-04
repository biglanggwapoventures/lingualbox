@extends('layouts.master')

@section('title', 'Profile')

@section('content')

@push('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
@endpush

@include('blocks.profile-navbar')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="panel-body text-center">
                                <img src="{{ Auth::user()->displayPhoto() }}" alt="" class="img-responsive img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <p class="text-center lead" style="border-top:1px solid #eee">{{ Auth::user()->fullname() }}</p>
                </div>
                <div class="list-group">
                    
                    @if(Auth::user()->isAdmin())
                    <a href="{{ route('profile') }}" class="list-group-item {{ Route::currentRouteNamed('profile') ? 'active' : '' }}">
                        <i class="fa fa-home fa-fw"></i> Dashboard
                    </a>
                    <a href="{{ route('written.questions.create') }}" class="list-group-item">
                        <i class="fa fa-pencil fa-fw"></i> Manage Written Exam
                    </a>
                    <a href="{{ route('reading.storyboard.edit') }}" class="list-group-item">
                        <i class="fa fa-book fa-fw"></i> Manage Reading Exam
                    </a>
                    <a href="{{ route('written.exam.list') }}" class="list-group-item {{ in_array(Route::currentRouteName(), ['written.exam.list', 'written.exam.view']) ? 'active' : '' }}">
                        <i class="fa fa-check fa-fw"></i> Check Written Exams <span class="badge">{{ $uncheckedWrittenExams }}</span>
                    </a>
                    <a href="{{ route('applicants.summary') }}" class="list-group-item {{ Route::currentRouteNamed('applicants.summary') ? 'active' : '' }}">
                        <i class="fa fa-users fa-fw"></i> Applicants Summary
                    </a>
                    <a href="{{ route('hired.summary') }}" class="list-group-item {{ Route::currentRouteNamed('hired.summary') ? 'active' : '' }}">
                        <i class="fa fa-users fa-fw"></i> Hired Summary
                    </a>
                    <a href="{{ route('needed.teachers') }}" class="list-group-item {{ Route::currentRouteNamed('needed.teachers') ? 'active' : '' }}">
                        <i class="fa fa-users fa-fw"></i> Needed Teachers
                        @if($isHiring)
                            <span class="badge"><i class="fa fa-exclamation-circle fa-fw"></i></span>
                        @endif 
                    </a>
                    <a href="{{ route('report.show') }}" class="list-group-item {{ Route::currentRouteNamed('report.show') ? 'active' : '' }}">
                        <i class="fa fa-pie-chart fa-fw"></i> Report
                    </a>
                    @elseif(Auth::user()->isHR())
                    <a href="{{ route('profile') }}" class="list-group-item {{ Route::currentRouteNamed('profile') ? 'active' : '' }}">
                        <i class="fa fa-home fa-fw"></i> Dashboard
                    </a>
                    <a href="{{ route('written.exam.list') }}" class="list-group-item {{ in_array(Route::currentRouteName(), ['written.exam.list', 'written.exam.view']) ? 'active' : '' }}">
                        <i class="fa fa-check fa-fw"></i> Check Written Exams <span class="badge">{{ $uncheckedWrittenExams }}</span>
                    </a>
                    <a href="{{ route('applicants.summary') }}" class="list-group-item {{ Route::currentRouteNamed('applicants.summary') ? 'active' : '' }}">
                        <i class="fa fa-users fa-fw"></i> Applicants Summary
                    </a>
                    <a href="{{ route('hired.summary') }}" class="list-group-item {{ Route::currentRouteNamed('hired.summary') ? 'active' : '' }}">
                        <i class="fa fa-users fa-fw"></i> Hired Summary
                    </a>
                    <a href="{{ route('needed.teachers') }}" class="list-group-item {{ Route::currentRouteNamed('needed.teachers') ? 'active' : '' }}">
                        <i class="fa fa-users fa-fw"></i> Needed Teachers 
                        @if($isHiring)
                            <span class="badge"><i class="fa fa-exclamation-circle fa-fw"></i></span>
                        @endif 
                    </a>
                    @endif

                    
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            @if(session()->has('password_reset'))
                <div class="alert alert-success text-center">
                    <p class="lead">
                        {{ session()->get('password_reset') }}
                    </p>
                </div>
            @endif
            @yield('profile-content')
        </div>
    </div>

</div>
@endsection

@push('js')
@stack('profile-js')
@endpush
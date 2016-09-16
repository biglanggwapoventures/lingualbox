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
                                <img src="{{ Auth::user()->displayPhoto() }}" alt="" class="img-responsive img-circle">
                            </div>
                        </div>
                    </div>
                    <p class="text-center lead" style="border-top:1px solid #eee">{{ Auth::user()->fullname() }}</p>
                </div>
                <div class="list-group">
                    <a href="{{ route('profile') }}" class="list-group-item {{ Route::currentRouteNamed('profile') ? 'active' : '' }}">
                        <i class="fa fa-home fa-fw"></i> Dashboard
                    </a>
                    @if(Auth::user()->isAdmin())
                    <a href="{{ route('written.questions.create') }}" class="list-group-item">
                        <i class="fa fa-pencil fa-fw"></i> Manage Written Exam
                    </a>
                    <a href="{{ route('reading.storyboard.edit') }}" class="list-group-item">
                        <i class="fa fa-book fa-fw"></i> Manage Reading Exam
                    </a>
                    @endif

                    <a href="{{ route('written.exam.list') }}" class="list-group-item {{ in_array(Route::currentRouteName(), ['written.exam.list', 'written.exam.view']) ? 'active' : '' }}">
                        <i class="fa fa-check fa-fw"></i> Check Written Exams
                    </a>
                    <a href="{{ route('applicants.summary') }}" class="list-group-item {{ Route::currentRouteNamed('applicants.summary') ? 'active' : '' }}">
                        <i class="fa fa-users fa-fw"></i> Applicants Summary
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            @yield('profile-content')
        </div>
    </div>

</div>
@endsection

@push('js')
@stack('profile-js')
@endpush
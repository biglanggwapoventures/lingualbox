@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="{{ asset('css/exams.css') }}">
@endpush

@section('title', 'Update Reading Exam')
@section('content')

<div class="container" style="padding-top:20px">
    <div class="row">
        <div class="col-sm-3">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="{{  Route::currentRouteNamed('reading.storyboard.edit') ? 'active' : ''}}">
                    <a href="{{ route('reading.storyboard.edit') }}"><i class="fa fa-book"></i> Storyboard</a>
                </li>
                @foreach($questions AS $key => $row)
                    <li role="presentation" class="{{  Route::currentRouteNamed('reading.questions.edit') && Route::input('id') == $row['id'] ? 'active' : ''}}">
                        <a href="{{ route('reading.questions.edit', ['id' => $row['id']]) }}"><i class="fa fa-circle-o"></i> Question {{ $key + 1}}</a>
                    </li>
                @endforeach
                <li role="presentation" class="{{  Route::currentRouteNamed('reading.questions.create') ? 'active' : ''}}">
                    <a href="{{ route('reading.questions.create') }}"><i class="fa fa-plus"></i> Add new question</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-9">
            <div class="well well-sm">
            
                @yield('form')
                
                
            </div>
        </div>
    </div>
</div>

@endsection
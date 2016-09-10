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
            </div>
            
        </div>
        <div class="col-sm-9">
            @yield('profile-content')
        </div>
    </div>

</div>
@endsection
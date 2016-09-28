@extends('layouts.master')

@section('title', 'Forgot password')

@section('content')

@include('blocks.navbar')

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-push-3">
            <div class="panel panel-default" style="border-radius:0px;margin-top:30px;">
                <div class="panel-body">
                    <div class="page-header" style="margin-top:0px;">
                        <h3 class="text-center">Reset your password</h3>
                    </div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                     <p class="lead">Please provide us with your new password</p>
                     {!! Form::open(['url' => '', 'method' => 'POST']) !!}
                        {!! Form::bsPassword('password', 'New password') !!}
                        {!! Form::bsPassword('password_confirmation', 'Confirm new password') !!}
                        <button type="submit" class="btn btn-success">Save</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
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
                        <h3 class="text-center">Recover your password</h3>
                    </div>
                     <p class="lead">Please provide your registered email address for us to help you recover your password.</p>
                     {!! Form::open(['url' => route('password.recover.email'), 'method' => 'POST']) !!}
                     @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                     <div class="input-group" >
                            {!! Form::email('email_address', null, ['class' => 'form-control input-lg']) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-lg" type="submit">Submit</button>
                            </span>
                     </div>
                      
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
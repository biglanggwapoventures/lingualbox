@extends('layouts.master')
@section('content')
@include('blocks.registration.nav')
<div class="container">
    <div class="col-sm-12">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <fieldset>
                        <p class="lead text-center">
                            <strong>INSTRUCTIONS</strong><br>
                                Read the question carefully and answer what is being asked.
                            <br>
                            
                        </p>
                        <p class="lead text-center">
                           You are about to take the written exam. Click on the button below to proceed.
                        </p>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">
                                {!! Form::open(['url' => route('written.exam'), 'method' => 'POST']) !!}
                                    <a class="btn btn-primary btn-block btn-lg" href="{{ route('written.exam') }}">Take the exam!</a>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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
                            Please choose the correct answer for the corresponding number. This exam has time limit. Please finish the exam before the time ends.
                            <br>
                        
                            
                        </p>
                        <p class="lead text-center">
                            If are about to take the reading exam. Click on the button below to proceed.
                        </p>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">
                                {!! Form::open(['url' => route('reading.exam'), 'method' => 'POST']) !!}
                                    <button class="btn btn-primary btn-block btn-lg" type="submit">Take the exam!</button>
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
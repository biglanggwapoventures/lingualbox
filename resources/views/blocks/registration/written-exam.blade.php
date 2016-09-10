@extends('layouts.master')
@section('content')
@include('blocks.registration.nav')
<div class="container-fluid">
    <div class="col-sm-12">
        {!! Form::open(['url' => route('written.exam.save'), 'method' => 'POST', 'id' => 'save', 'class' => 'common']) !!}
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="alert alert-success text-center" id="timer" data-limit="{{ $essay->limit }}" style="font-size:150%">
                                
                            </div>

                            <p class="lead" style="text-align:justify;font-size:130%">{!! $essay->body !!}</p>
                            <div class="form-group">
                                 {!! Form::textarea('answer', null, ['class' => 'form-control', 'placeholder' => 'Enter your answer here']) !!}
                            </div>
                           
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            
        {!! Form::close() !!}
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript" src="{{ asset('js/timer.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/wexam.js') }}"></script>
@endpush
@extends('layouts.master')

@section('content')
@include('blocks.registration.nav')
<div class="container-fluid">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="well">
            <fieldset>
                <legend class="text-center" style="border-bottom:0;margin-bottom:30px">Please input and upload needed requirements</legend>
                {!! Form::open(['url' => route('register.third.save'), 'method' => 'post', 'id' => 'third-registration',  'files' => TRUE, 'data-next'=>route('pre.reading.exam')]) !!}
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            {{ Form::label('work_schedule', 'Preferred work schedule' )}}
                             {{ Form::select('work_schedule', ['' => '', 'MORNING' => 'Morning (6AM - 12NN)', 'AFTERNOON' => 'Afternoon (12NN - 6PM)', 'EVENING' => 'Evening (6PM - 12AM)', 'MIDNIGHT' => 'Midnight (12AM - 6AM)', ], $preference->work_schedule, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <hr>
                <p class="text-center lead">What is your preferred day and time for a demonstration?</p>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('demo_day', 'Day of week' )}}
                            {{ Form::select('demo_day', ['' => '', 'MON' => 'Monday', 'TUE' => 'Tuesday', 'WED' => 'Wednesday', 'THU' => 'Thursday', 'FRI' => 'Friday', 'SAT' => 'Saturday', 'SUN' => 'Sunday'], $preference->demo_day, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::bsText('demo_time', $preference->demo_time, 'Time', []) }}
                        </div>
                    </div>
                </div>
                <hr>
                <p class="text-center lead">Upload files</p>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('certifications', 'Certificates (if any)' )}}
                            {{ Form::file('certifications', ['multiple' => TRUE,  'accept'=>'image/*']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('internet_speed_screenshot', 'Screeshot of your internet speed')}}
                            {{ Form::file('internet_speed_screenshot', ['accept'=>'image/*']) }}
                        </div>
                         <div class="alert alert-info">
                            <p>
                            <b><i class="glyphicon glyphicon-info-sign"></i></b> Use <a href="http://www.usen.com/speedtest02/adsl/speedtest.html" target="_blank">USEN</a>  for testing your internet speed
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('display_photo', 'Display photo' )}}
                            {{ Form::file('display_photo', ['accept'=>'image/*']) }}
                           
                        </div>
                    </div>
                </div>
               
                <button type="submit" class="btn btn-success pull-right">Save</button>
                {!! Form::close() !!}
            </fieldset>
        </div>
    </div>
</div>
@endsection
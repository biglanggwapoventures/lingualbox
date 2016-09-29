@extends('layouts.master')


@section('content')
@include('blocks.registration.nav')
<div class="container-fluid">
  <div class="col-sm-8 col-sm-offset-2">
    <div class="well">
        <fieldset>
            <legend class="text-center" style="border-bottom:0;margin-bottom:30px">Let's create your profile together<br><small>Please give us some information about you before continuing</small></legend>
            {!! Form::open(array('url' => route('register.first.save'), 'method' => 'post', 'id' => 'first-registration', 'data-next' => route('register.second'))) !!}
                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::bsText('firstname', $user->firstname, 'First name', []) }}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::bsText('lastname',  $user->lastname, 'Last name', []) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group bday">
                            <label for="" class="control-label">Birthday</label>
                            
                            <div class="row">
                                <div class="col-sm-6 birthmonth">
                                    {!! Form::selectMonth('birthmonth', $user->getBirth('month'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-sm-3 birthday">
                                    {!! Form::selectRange('birthday', 1, 31, $user->getBirth('day'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-sm-3 birthyear">
                                    {!! Form::selectRange('birthyear', 1998, 1955, $user->getBirth('year'), ['class' => 'form-control']) !!}
                                </div>
                                
                            </div>
                            {{ Form::hidden('birthdate') }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('gender', 'Gender', ['class' => 'control-label']) !!}
                                    {{ Form::select('gender', ['' => '', 'MALE' => 'Male', 'FEMALE' => 'Female'], $user->gender, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('marital_status', 'Marital Status', ['class' => 'control-label']) !!}
                                    {{ Form::select('marital_status', ['' => '', 'SINGLE' => 'Single', 'MARRIED' => 'Married'], $user->marital_status, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        {{ Form::bsText('mobile_number', $user->mobile_number, 'Mobile number', ['placeholder' => 'e.g. 09191234567']) }}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::bsText('email_address', $user->email_address, 'Email address', []) }}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::bsText('skype_account', $user->skype_account, 'Skype account', []) }}
                    </div>
                </div>
                <hr>
                {{ Form::bsText('street_address', $user->street_address, 'Home address', ['placeholder' => 'e.g. #01 Apple St. Brgy Talamban']) }}
                <div class="row">
                    <div class="col-sm-4">
                        {{ Form::bsText('city', $user->city, 'City', ['placeholder' => 'e.g. Cebu City']) }}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::bsText('province', $user->province, 'Province', ['placeholder' => 'e.g. Cebu']) }}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::bsText('country', $user->country, 'Country', ['placeholder' => 'e.g. Philippines']) }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::bsPassword('password', 'Password') }}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::bsPassword('password_confirmation', 'Password confirmation') }}
                    </div>
                </div>
                <button type="submit" class="btn btn-success pull-right">Save</button>
            {!! Form::close() !!}
        </fieldset>
    </div>
  </div>
</div>
@endsection
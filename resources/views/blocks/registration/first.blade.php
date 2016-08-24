@extends('blocks.registration.master')
@section('partOneCurrent', 'active')

@section('form')
 <fieldset>
        <legend class="text-center">Let's create your profile together<br><small>Please give us some information about you before continuing</small></legend>
        {!! Form::open(array('url' => 'registration/first-step', 'method' => 'post')) !!}
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::bsText('firstname', null, 'First name', []) }}
                </div>
                <div class="col-sm-6">
                    {{ Form::bsText('lastname', null, 'First name', []) }}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group bday">
                        <label for="">Birthday</label>
                        <div class="row">
                            <div class="col-sm-6 birthmonth">
                                {!! Form::selectMonth('birthmonth', FALSE, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-3 birthday">
                                {!! Form::selectRange('birthday', 1, 31, '', ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-3 birthyear">
                                 {!! Form::selectRange('birthyear', 1990, date('Y'), '', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('gender', 'Gender') !!}
                                {{ Form::select('gender', ['' => '', 'MALE' => 'Male', 'FEMALE' => 'Female'], '', ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('marital_status', 'Marital Status') !!}
                                {{ Form::select('marital_status', ['' => '', 'SINGLE' => 'Single', 'MARRIED' => 'Married'], '', ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    {{ Form::bsText('mobile_number', null, 'Mobile number', []) }}
                </div>
                <div class="col-sm-4">
                    {{ Form::bsText('email_address', null, 'Email address', []) }}
                </div>
                <div class="col-sm-4">
                    {{ Form::bsText('skype_account', null, 'Skype account', []) }}
                </div>
            </div>
            <hr>
            {{ Form::bsText('street_address', null, 'Street address', []) }}
            <div class="row">
                <div class="col-sm-4">
                    {{ Form::bsText('city', null, 'City', []) }}
                </div>
                <div class="col-sm-4">
                    {{ Form::bsText('province', null, 'Province', []) }}
                </div>
                <div class="col-sm-4">
                    {{ Form::bsText('country', null, 'Country', []) }}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::bsText('password', null, 'Password', []) }}
                </div>
                <div class="col-sm-6">
                    {{ Form::bsText('confirm_password', null, 'Password confirmation', []) }}
                </div>
            </div>
            <button type="submit" class="btn btn-success pull-right">Save</button>
        {!! Form::close() !!}
</fieldset>
@endsection
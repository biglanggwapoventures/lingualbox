@extends('profile')

@section('profile-content')

<div class="panel panel-default">
    
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>Needed Teachers</h2>
        </div>
        {!! Form::open(['url' => route('needed.teachers.save'), 'method' => 'POST', 'class' => 'common form-horizontal']) !!}
            @if($demand->fulfilled)
                <div class="alert alert-success">
                    <i class="fa fa-check"></i> The HR has hired the needed teachers!
                </div>
            @endif
            <div class="form-group">
                <label class="col-sm-4 control-label">Morning</label>
                <div class="col-sm-6">
                    {!! Form::text('morning', $demand->morning, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Afternoon</label>
                <div class="col-sm-6">
                   {!! Form::text('afternoon', $demand->afternoon, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Evening</label>
                <div class="col-sm-6">
                    {!! Form::text('evening', $demand->evening, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Midnight</label>
                <div class="col-sm-6">
                    {!! Form::text('midnight', $demand->midnight, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
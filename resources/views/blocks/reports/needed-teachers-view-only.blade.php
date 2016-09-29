@extends('profile')

@section('profile-content')

<div class="panel panel-default">
    
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>Needed Teachers</h2>
        </div>
        {{ Form::open(['url' => route('needed.teachers.fulfill'), 'method' => 'PATCH', 'class' => 'form-horizontal common', 'data-next' => route('needed.teachers')]) }}
            <div class="form-group">
                <label class="col-sm-4 control-label">Morning</label>
                <div class="col-sm-6">
                    <p class="form-control-static">
                        {{ $demand->morning }}
                    </p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Afternoon</label>
                <div class="col-sm-6">
                    <p class="form-control-static">
                        {{ $demand->afternoon }}
                    </p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Evening</label>
                <div class="col-sm-6">
                    <p class="form-control-static">
                        {{ $demand->evening }}
                    </p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Midnight</label>
                <div class="col-sm-6">
                    <p class="form-control-static">
                        {{ $demand->midnight }}
                    </p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                <button type="submit" class="btn btn-success">Done Hiring</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
@extends('profile')

@section('profile-content')

<div class="panel panel-default">
    
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>HR Dashboard</h2>
        </div>
        <div class="row">
            <div class="col-sm-3 col-xs-6">
                <a class="menu-icon" href="{{ route('written.exam.list') }}">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <i class="fa fa-check fa-5x  fa-fw"></i>
                        </div>
                        <div class="panel-footer text-center"> 
                            Check Written Exams
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 col-xs-6">
                <a class="menu-icon" href="{{ route('applicants.summary') }}">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <i class="fa fa-users fa-5x  fa-fw"></i>
                        </div>
                        <div class="panel-footer text-center"> s
                            Applicants Summary
                        </div>
                    </div>
                </a>
            </div>
             <div class="col-sm-3 col-xs-6">
                <a class="menu-icon" href="{{ route('hired.summary') }}">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <i class="fa fa-user fa-5x  fa-fw"></i>
                        </div>
                        <div class="panel-footer text-center"> 
                            Hired Summary
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 col-xs-6">
                <a class="menu-icon" href="{{ route('needed.teachers') }}">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <i class="fa fa-users fa-5x  fa-fw"></i>
                        </div>
                        <div class="panel-footer text-center"> 
                            Needed Teachers
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('profile')

@section('profile-content')
<div class="panel panel-default">
    
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>Admin Dashboard</h2>
        </div>
        <div class="row">
            <div class="col-sm-3 col-xs-6">
                <a class="menu-icon" href="{{ route('reading.storyboard.edit') }}">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <i class="fa fa-book fa-5x  fa-fw"></i>
                        </div>
                        <div class="panel-footer text-center"> 
                            Manage Reading Exam
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 col-xs-6">
                <a class="menu-icon"  href="{{ route('written.questions.create') }}">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <i class="fa fa-pencil fa-5x  fa-fw"></i>
                        </div>
                        <div class="panel-footer text-center"> 
                            Manage Written Exam
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3 col-xs-6">
                <a class="menu-icon" href="{{ route('applicants.summary') }}">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <i class="fa fa-user fa-5x  fa-fw"></i>
                        </div>
                        <div class="panel-footer text-center"> 
                            Applicants Summary
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.master')

@section('title', 'Profile')

@section('content')

<nav class="navbar navbar-default profile">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('home') }}">Lingualbox</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Hello, {{ Auth::user()->firstname }} <b class="caret"></b>
            </a>
          <ul class="dropdown-menu">
            <li><a href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="panel-body text-center">
                                <img src="{{ $displayPhoto }}" alt="" class="img-responsive img-circle">
                            </div>
                        </div>
                    </div>
                    <p class="text-center lead" style="border-top:1px solid #eee">{{ $user->fullname() }}</p>
                </div>
            </div>
            
        </div>
        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h3 class="panel-title">
                        Application Information
                   </h3>
                </div>
                <div class="panel-body">
                    @if($profileProgress < 100)
                        <p class="text-info text-center"><i class="glyphicon glyphicon-info-sign"></i> Application Progress</p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="{{ $profileProgress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $profileProgress }}%">
                                <span class="sr-only">{{ $profileProgress }}% Complete (success)</span>
                                {{ $profileProgress }}%
                            </div>
                        </div>
                        <div class="alert alert-warning">
                            <b>Uh, oh!</b>
                            <p>Seems like you are not yet done with your whole application process. You can review your progress below</p>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                 <table class="table table-hover table-bordered">
                                    <tbody>
                                        <tr>
                                            <td style="width:70%">Personal Information</td>
                                            <td style="width:10%"><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                            <td style="width:10%"><a href="" class="btn btn-info btn-xs">Review</a></td>
                                            <td style="width:10%"><span class="label label-primary">20%</span></td>
                                        </tr>
                                        <tr> 
                                            <td>Work Experiences</td>
                                            @if($profileProgress >= 40)
                                                <td><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                                <td><a class="btn btn-info btn-xs">Review</a></td>
                                            @else
                                                <td colspan="2"><a class="btn btn-info btn-xs btn-block" href="{{ route('register.second') }}">Take</a></td>
                                            @endif
                                            <td><span class="label label-primary">20%</span></td>
                                        <tr>
                                            <td>Requirements</td>
                                            @if($profileProgress >= 50)
                                                <td><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                                <td><a class="btn btn-info btn-xs" href="{{ route('register.third') }}">Review</a></td>
                                            @else
                                                <td colspan="2"><a class="btn btn-info btn-xs btn-block" href="{{ route('register.third') }}">Take</a></td>
                                            @endif
                                            <td><span class="label label-primary">10%</span></td>
                                        </tr>
                                        <tr>
                                            <td>Reading Exam</td>
                                            @if($profileProgress >= 70)
                                                <td><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                                <td><a class="btn btn-info btn-xs">Review</a></td>
                                            @else
                                                <td colspan="2"><a class="btn btn-info btn-xs btn-block">Take</a></td>
                                            @endif
                                            <td><span class="label label-primary">20%</span></td>
                                        </tr>
                                        <tr>
                                            <td>Written Exam</td>
                                            @if($profileProgress >= 80)
                                                <td><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                                <td><a class="btn btn-info btn-xs">Review</a></td>
                                            @else
                                               <td colspan="2"><a class="btn btn-info btn-xs btn-block">Take</a></td>
                                            @endif
                                            <td><span class="label label-primary">10%</span></td>
                                        </tr>
                                        <tr>
                                            <td>Demonstration</td>
                                            @if($profileProgress >= 100)
                                                <td><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                                <td><a class="btn btn-info btn-xs">Review</a></td>
                                            @else
                                               <td colspan="2"><a class="btn btn-info btn-xs btn-block">Take</a></td>
                                            @endif
                                            <td><span class="label label-primary">20%</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-center hidden">
                            <a class="btn btn-success btn-lg">Continue <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        
                   @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@extends('profile')

@section('profile-content')


        @if($profileProgress < 100)
            <div class="panel panel-default">
    
                <div class="panel-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="{{ $profileProgress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $profileProgress }}%">
                            <span class="sr-only">{{ $profileProgress }}% Complete (success)</span>
                            {{ $profileProgress }}%
                        </div>
                    </div>
                    <div class="alert alert-danger">
                        <p>Seems like you are not yet done with your whole application process. You can review your progress below</p>
                    </div>
                    @if(!Auth::user()->isAccountVerified())
                        <div class="alert alert-danger">
                            <p>Your account is not yet verified. Please check you email inbox to verify your account. If you haven't received any email, you can click <a href="{{ route('email.verification.resend') }}">here</a> to resend the verification link.</p>
                        </div>
                    @endif
                    @if(session()->has('email_verification_ok'))
                        <div class="alert alert-success text-center">
                            <i class="fa fa-check"></i> Your account has been verified!
                        </div>
                    @endif
                    @if(session()->has('email_verification_notice'))
                        <div class="alert alert-danger text-center">
                            <i class="fa fa-times"></i> {{ session()->get('email_verification_notice') }}
                        </div>
                    @endif
                    @if(session()->has('reading_exam_result_passed'))
                        <div class="alert alert-success text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p class="lead">
                                <i class="fa fa-check"></i>  Congratulations! You passed the reading exam! You can now proceed to the written exam.
                            </p>
                        </div>
                    @endif

                    @if(Auth::user()->latestReadingExam()->exists()  && !Auth::user()->latestReadingExam->didPassed())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p class="lead">
                                <i class="fa fa-exclamation-circle"></i> You failed the reading exam! You can reapply for the reading exam in {{ Auth::user()->nextReadingExam() }}
                            </p>
                        </div>
                    @endif

                    @if(Auth::user()->latestWrittenExam()->exists())
                        @if(Auth::user()->latestWrittenExam->result === 'FAILED')
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p class="lead">
                                    <i class="fa fa-exclamation-circle"></i> You failed the written exam! You can reapply for the reading exam in {{ Auth::user()->nextWrittenExam() }}
                                </p>
                            </div>
                        @elseif(!Auth::user()->latestWrittenExam->result)
                            <div class="alert alert-warning text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <p class="lead">
                                    <i class="fa fa-info"></i>  Please check your email after 3 days for the result of your written exam.
                                </p>
                            </div>
                        @endif
                    @endif

                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                                <table class="table table-hover table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="width:50%">Personal Information</td>
                                        <td style="width:20%" class="text-center"><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                        <td style="width:20%" class="text-center"><a href="{{ route('register.first') }}" class="btn btn-info btn-xs">Review</a></td>
                                        <td style="width:10%"><span class="label label-primary">20%</span></td>
                                    </tr>
                                    <tr> 
                                        <td>Work Experiences</td>
                                        @if($profile['experiences']['done'])
                                            <td class="text-center"><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                            <td class="text-center"><a class="btn btn-info btn-xs" href="{{ route('register.second') }}">Review</a></td>
                                        @else
                                            <td colspan="2"><a class="btn btn-info btn-xs btn-block" href="{{ route('register.second') }}">Take</a></td>
                                        @endif
                                        <td><span class="label label-primary">{{ $profile['experiences']['percent'] }}%</span></td>
                                    <tr>
                                        <td>Requirements</td>
                                        @if($profile['requirements']['done'])
                                            <td class="text-center"><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                            <td class="text-center"><a class="btn btn-info btn-xs" href="{{ route('register.third') }}">Review</a></td>
                                        @else
                                            @if($profileProgress < 40)
                                                <td colspan="2" class="text-warning text-center">Please finish &quot;Work Experiences&quot;</td> 
                                            @else
                                                <td colspan="2"><a class="btn btn-info btn-xs btn-block" href="{{ route('register.third') }}">Take</a></td>
                                            @endif
                                        @endif
                                        <td><span class="label label-primary">{{ $profile['requirements']['percent'] }}%</span></td>
                                    </tr>
                                    <tr>
                                        <td>Reading Exam</td>
                                        @if($profile['reading']['done'])
                                        
                                            <td class="text-center" colspan="2">
                                                @if($profile['reading']['status'] === 'P')
                                                    <span class="label label-success">
                                                        <i class="fa fa-check"></i> Passed
                                                    </span>
                                                @else
                                                    <span class="label label-danger">
                                                        <i class="fa fa-times"></i> Failed
                                                    </span>
                                                @endif
                                            </td>
                                        
                                        @else
                                            @if($profileProgress < 50)
                                            <td colspan="2" class="text-warning text-center">Please finish &quot;Requirements&quot;</td> 
                                            @else
                                                <td colspan="2"><a class="btn btn-info btn-xs btn-block" href="{{ route('pre.reading.exam') }}">Take</a></td>
                                            @endif
                                        @endif
                                        <td><span class="label label-primary">20%</span></td>
                                    </tr>
                                    <tr>
                                        <td>Written Exam</td>
                                        @if($profile['written']['done'])
                                            <td class="text-center" colspan="2">
                                                @if($profile['written']['status'] === 'P')
                                                    <span class="label label-success">
                                                        <i class="fa fa-check"></i> Passed
                                                    </span>
                                                @elseif($profile['written']['status'] === 'W')
                                                    <span class="label label-warning">
                                                        <i class="fa fa-times"></i> Pending for checking
                                                    </span>
                                                @else
                                                    <span class="label label-danger">
                                                        <i class="fa fa-times"></i> Failed
                                                    </span>
                                                @endif
                                            </td>
                                        @else
                                            @if($profileProgress < 70 || $profile['reading']['status'] !== 'P')
                                            <td colspan="2" class="text-warning text-center">Please finish &quot;Reading Exam&quot;</td> 
                                            @else
                                                <td colspan="2"><a href="{{ route('pre.written.exam') }}" class="btn btn-info btn-xs btn-block">Take</a></td>
                                            @endif
                                        @endif
                                        <td><span class="label label-primary">10%</span></td>
                                    </tr>
                                    <tr>
                                        <td>Demonstration</td>
                                        @if(!$profile['requirements']['done'])
                                            <td colspan="2" class="text-warning text-center">Please finish &quot;Written Exam&quot;</td> 
                                        @else
                                            <td colspan="2"><a class="btn btn-info btn-xs btn-block" data-toggle="modal" data-target="#ins">View instructions</a></td>
                                            <div class="modal fade" tabindex="-1" role="dialog" id="ins">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Demo Class Instructions</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Auth::user()->demoClass->getFormattedInstructions() !!}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                        @endif

                                        <td><span class="label label-primary">{{ $profile['requirements']['percent'] }}%</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center hidden">
                        <a class="btn btn-success btn-lg">Continue <span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                </div>

            </div>
            
        @else

            <div class="panel panel-default">
    
                <div class="panel-body">
                    <div class="page-header text-center" style="margin-top:0">
                        <h2>Teacher Dashboard</h2>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <a class="menu-icon" target="_blank" href="https://hackpad.com/LingualBox-Rules-for-Teachers-MC38Cn28dRU" >
                                <div class="panel panel-default">
                                    <div class="panel-body text-center">
                                        <i class="fa fa-list-alt fa-5x  fa-fw"></i>
                                    </div>
                                    <div class="panel-footer text-center"> 
                                        Rules and Regulation
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <a class="menu-icon" target="_blank" href="https://hackpad.com/Instruction-for-receiving-salary-BCDdSYtQhBu" >
                                <div class="panel panel-default">
                                    <div class="panel-body text-center">
                                        <i class="fa fa-dollar fa-5x  fa-fw"></i>
                                    </div>
                                    <div class="panel-footer text-center"> 
                                        Payment System
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <table class="table">
                        <thead>
                             <tr>
                                <th colspan="4" class="text-center">Your Working Details</th>
                            </tr>
                            <tr>
                                <th>Shift</th><th>Working Days</th><th>Time Schedule</th><th>Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ Auth::user()->hireStatus->shift }}</td>
                                <td>{{ implode(', ', Auth::user()->hireStatus->work_days) }}</td>
                                <td>{{ Auth::user()->hireStatus->time_schedule }}</td>
                                <td>{{ number_format(Auth::user()->hireStatus->rate, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
@endsection

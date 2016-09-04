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
                <div class="col-sm-10 col-sm-offset-1">
                        <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:50%">Personal Information</td>
                                <td style="width:20%"><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                <td style="width:20%"><a href="" class="btn btn-info btn-xs">Review</a></td>
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
                                    @if($profileProgress < 50)
                                        <td colspan="2" class="text-warning text-center">Please finish &quot;Work Experiences&quot;</td> 
                                    @else
                                        <td colspan="2"><a class="btn btn-info btn-xs btn-block" href="{{ route('register.third') }}">Take</a></td>
                                    @endif
                                @endif
                                <td><span class="label label-primary">10%</span></td>
                            </tr>
                            <tr>
                                <td>Reading Exam</td>
                                @if($profileProgress >= 70)
                                    <td><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                    <td><a class="btn btn-info btn-xs">Review</a></td>
                                @else
                                    @if($profileProgress < 50)
                                       <td colspan="2" class="text-warning text-center">Please finish &quot;Requirements&quot;</td> 
                                    @else
                                         <td colspan="2"><a class="btn btn-info btn-xs btn-block">Take</a></td>
                                    @endif
                                @endif
                                <td><span class="label label-primary">20%</span></td>
                            </tr>
                            <tr>
                                <td>Written Exam</td>
                                @if($profileProgress >= 80)
                                    <td><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                    <td><a class="btn btn-info btn-xs">Review</a></td>
                                @else
                                    @if($profileProgress < 70)
                                       <td colspan="2" class="text-warning text-center">Please finish &quot;Reading Exam&quot;</td> 
                                    @else
                                        <td colspan="2"><a class="btn btn-info btn-xs btn-block">Take</a></td>
                                    @endif
                                @endif
                                <td><span class="label label-primary">10%</span></td>
                            </tr>
                            <tr>
                                <td>Demonstration</td>
                                @if($profileProgress >= 100)
                                    <td><span class="label label-success"><i class="glyphicon glyphicon-check"></i> Done</span></td>
                                    <td><a class="btn btn-info btn-xs">Review</a></td>
                                @else
                                     @if($profileProgress < 80)
                                       <td colspan="2" class="text-warning text-center">Please finish &quot;Written Exam&quot;</td> 
                                    @else
                                        <td colspan="2"><a class="btn btn-info btn-xs btn-block">Take</a></td>
                                    @endif
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
@extends('profile')

@section('profile-content')

<div class="panel panel-default">
    {!! Form::open(['url'=>route('written.exam.check', ['id' => $exam->id ]), 'method' => 'POST', 'id' => 'check-exam']) !!}
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>Check Applicant Written Exams</h2>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label">Applicant Name</label>
                    <p class="form-control-static">{{ $exam->user->fullname() }}</p>
                </div>
                
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label">Applicant Gender</label>
                    <p class="form-control-static">{{ $exam->user->gender }}</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label">Date taken</label>
                    <p class="form-control-static">{{ $exam->datetimeStartedFormatted() }}</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="well well-sm">
                    <p>{!! $exam->essay->formattedBody() !!}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <p>{!!  $exam->formattedAnswer() !!}</p>
            </div>
        </div>
    </div>
    <div class="panel-footer cleafix">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#email">Passed</button>
        <button type="button" class="btn btn-danger pull-right check" data-value="FAILED">Failed</button>
    </div>
    {!! Form::close() !!}
</div>


<div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Notify applicant of demo class details</h4>
      </div>
      <div class="modal-body">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 3]) !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary check" data-value="PASSED">Send</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('profile-js')
<script type="text/javascript" src="{{ asset('js/check-written-exam.js') }}"></script>
@endpush
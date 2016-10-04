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
        <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#reason">Failed</button>
    </div>
    {!! Form::close() !!}
</div>


<div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Input the demo class schedule, lesson material to be used and the skype account</h4>
      </div>
      {!! Form::open(['url' => route('written.exam.check', ['id' => $exam->id ]), 'class' => 'form common', 'method' => 'POST']) !!}
        <div class="modal-body">
            {!! Form::hidden('result', 'PASSED') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 3]) !!}
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      {!!  Form::close() !!}
    </div>
  </div>
</div>

<div class="modal fade" id="reason" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Input reason for failing:</h4>
      </div>
      {!! Form::open(['url' => route('written.exam.check', ['id' => $exam->id ]), 'class' => 'form common', 'method' => 'POST']) !!}
        <div class="modal-body">
            {!! Form::hidden('result', 'FAILED') !!}
            <div class="checkbox">
                <label><input type="checkbox" class="fail-reason" name="reason[]" value="Grammar mistakes"/> Grammar mistakes</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" class="fail-reason" name="reason[]" value="Lack of thought"/> Lack of thought</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" class="fail-reason" name="reason[]" value="Plagiarism"/> Plagiarism</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" class="fail-reason" name="reason[]" value="Essay too short"/> Essay too short</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" class="fail-reason other-reason" value="OTHERS" name="reason[]" /> Others (please specify)</label>
            </div>
            <div class="form-group">
                {!! Form::textarea('reason[]', null, ['class' => 'form-control fail-reason', 'rows' => 3]) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      {!!  Form::close() !!}
    </div>
  </div>
</div>



@endsection

@push('profile-js')
<script type="text/javascript" src="{{ asset('js/check-written-exam.js') }}"></script>
@endpush
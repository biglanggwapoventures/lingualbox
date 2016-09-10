@extends('profile')

@section('profile-content')

<div class="panel panel-default">
    
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>Check Applicant Written Exams</h2>
        </div>
        <form action="">
            <dl>
                <dt>Applicant</dt>
                <dd>{{ $exam->user->fullname() }}</dd>
                 <dt>Gender</dt>
                <dd>{{ $exam->user->gender }}</dd>
                 <dt>Exam date</dt>
                <dd>{{ $exam->datetimeStartedFormatted() }}</dd>
            </dl>
             <dl>
                <dt>Exam Question</dt>
                <dd>{{ $exam->essay->formattedBody() }}</dd>
            </dl>
            <dl>
                <dt>Applicant's Answer</dt>
                <dd>{{ $exam->formattedAnswer() }}</dd>
            </dl>
        </form>
    </div>
</div>


@endsection
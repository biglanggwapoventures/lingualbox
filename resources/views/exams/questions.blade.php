@extends('exams.manage')

@section('form')
<div class="page-header text-center">
    <h2>
        {{ $title }}
    </h3>
</div>

{!! Form::open(['url' => $action, 'method' => 'POST', 'class' => 'common form-horizontal']) !!}

    <div class="form-group">
        <div class="col-sm-3">
            {!! Form::label('body', 'Question body', ['class' =>'control-label']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::textarea('body', $question->body, ['class' => 'form-control']) !!}
        </div>
        
    </div>
     <!-- CORRECT -->
     @foreach ($question->correct_answers AS $key => $answer)
         <div class="form-group correct">
            <div class="col-sm-3">
                {!! Form::label('', $key === 0 ? 'Correct answer(s)' : '', ['class' =>'control-label']) !!}
            </div>
            <div class="col-sm-7">
                {!! Form::text('correct_answers[]', $answer, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-2"><a class="btn btn-danger remove  {{ $key === 0 ? 'invisible' : ''}}"><i class="fa fa-times"></i></a></div>
        </div>
    @endforeach
    <div class="form-group">
        <div class="col-sm-3">
            {!! Form::label('', '', ['class' =>'control-label']) !!}
        </div>
        <div class="col-sm-8">
            <a href="" class="btn btn-info mod-question" data-mode="correct"><i class="fa fa-plus"></i>  Add correct answer</a>
        </div>
    </div>
   
    <!-- WRONG -->
    @foreach ($question->wrong_answers AS $key => $answer)
         <div class="form-group correct">
            <div class="col-sm-3">
                {!! Form::label('', $key === 0 ? 'Wrong answer(s)' : '', ['class' =>'control-label']) !!}
            </div>
            <div class="col-sm-7">
                {!! Form::text('wrong_answers[]', $answer, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-2"><a class="btn btn-danger remove  {{ $key === 0 ? 'invisible' : ''}}"><i class="fa fa-times"></i></a></div>
        </div>
    @endforeach
    <div class="form-group">
        <div class="col-sm-3">
            {!! Form::label('', '', ['class' =>'control-label']) !!}
        </div>
        <div class="col-sm-8">
            <a href="" class="btn btn-info mod-question" data-mode="wrong"><i class="fa fa-plus"></i>  Add wrong answer</a>
        </div>
    </div>
    

     <hr/>
    <button type="submit" class="btn btn-success btn-lg btn-block">Save</button>

{!! Form::close() !!}

@endsection
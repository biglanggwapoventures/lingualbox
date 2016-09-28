@extends('exams.manage')

@section('form')

{!! Form::open(['url' => $action, 'method' => 'POST', 'class' => 'common form-horizontal']) !!}
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="page-header text-center" style="margin-top:0">
                <h2>{{ $title }}</h2>
            </div>
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
                <div class="form-group wrong">
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
            <button type="submit" class="btn btn-success">Submit</button>
             @if(isset($question->id))
                <button data-toggle="modal" data-target="#myModal" class="btn btn-danger pull-right" type="button">Delete</button>
            @endif
        </div>
    </div>
{!! Form::close() !!}

@if(isset($question->id))
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            {!! Form::open(['url' => route('reading.questions.delete'), 'method' => 'DELETE', 'class' => 'common' ]) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! Form::hidden('id', $question->id) !!}
                    <h4 class="modal-title">Confirm deletion</h4>
                </div>
                <div class="modal-body">
                    <p class="lead text-center text-danger">Are you sure you want to delete this?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
 @endif

@endsection
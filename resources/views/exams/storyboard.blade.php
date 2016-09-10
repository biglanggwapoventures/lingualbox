@extends('exams.manage')

@section('form')

{!! Form::open(['url' => route('reading.storyboard.save'), 'method' => 'POST', 'class' => 'common']) !!}
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="page-header text-center" style="margin-top:0">
                <h2>Edit Storyboard</h2>
            </div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="form-group">
                {!! Form::label('title', 'Story Title') !!}
                {!! Form::text('title', $story->title, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('body', 'Story Body') !!}
                {!! Form::textarea('body', $story->body, ['class' => 'form-control']) !!}
            </div>

            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="form-group">
                        {!! Form::label('passing_score', 'Passing Score') !!}
                        {!! Form::text('passing_score', $story->passing_score, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="form-group">
                        {!! Form::label('limit', 'Time Limit') !!}
                        {!! Form::text('limit', $story->limit, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            

            <hr/>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>
{!! Form::close() !!}

@endsection
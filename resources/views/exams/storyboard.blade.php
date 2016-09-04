@extends('exams.manage')

@section('form')
<div class="page-header text-center">
    <h2>
        Edit Storyboard
    </h3>
</div>

{!! Form::open(['url' => route('reading.storyboard.save'), 'method' => 'POST', 'class' => 'common']) !!}
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
        {!! Form::text('title', $story->title, ['class' => 'form-control input-lg']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('body', 'Story Body') !!}
        {!! Form::textarea('body', $story->body, ['class' => 'form-control']) !!}
    </div>

     <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
                {!! Form::label('limit', 'Time Limit') !!}
                {!! Form::text('limit', $story->limit, ['class' => 'form-control input-lg']) !!}
            </div>
        </div>
     </div>

     <hr/>
    <button type="submit" class="btn btn-success btn-lg btn-block">Save</button>

{!! Form::close() !!}

@endsection
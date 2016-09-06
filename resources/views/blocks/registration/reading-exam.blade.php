@extends('layouts.master')
@section('content')
@include('blocks.registration.nav')
<style>
  .pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
</style>
<div class="container-fluid">
    <div class="col-sm-12">
        {!! Form::open(['url' => route('reading.exam.save'), 'method' => 'POST', 'class' => 'common']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-body" style="font-size:120%;text-align:justify">
                            <p class="lead text-center">{{ $story->title }}</p>
                            {!! $story->body !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                                <p class="lead text-center text-info"  id="countdown" data-limit="{{ $story->limit }}"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            @foreach($questions AS $i => $q)
                                <div class="item {{ $i > 0 ? 'hidden' : '' }}" data-item="{{ $q->id }}" item>
                                   <p class="lead text-center">
                                     {{ $q->body }}
                                   </p>
                                    <div class="mc-answer"> 
                                        @foreach($q->choices AS $ii => $c)
                                        <div class="mc-answer__item">
                                            <input id="{{ "{$i}{$ii}" }}" value="{{$c}}" type="checkbox" name="item[{{ $q->id }}][answers][]" class="mc-answer__input"/>
                                            <label for="{{ "{$i}{$ii}" }}" class="mc-answer__label">{{ $c }}</label>
                                            <div class="mc-answer__check-outer"> </div>
                                            <div class="mc-answer__check-inner"> </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                             @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 text-center">
                            <ul class="pagination">
                            @foreach($questions AS $i => $q)
                                <li><a href="#" data-toggle="item" data-target="{{ $q->id }}">{{ $i + 1 }}</a></li>
                            @endforeach
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Are you sure?')">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        {!! Form::close() !!}
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript" src="{{ asset('js/timer.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/exam.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/exam.css') }}">
@endpush
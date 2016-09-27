@extends('layouts.master')
@section('content')
@include('blocks.registration.nav')
@push('css')
<link rel="stylesheet" href="{{ asset('css/bstimepicker.min.css') }}">
@endpush
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="well">

            <fieldset>
                    <legend class="text-center" style="border-bottom:0;margin-bottom:30px">Let's add your work experiences<br><small>Please input your work experience as a teacher.</small></legend>
                    {!! Form::open(array('url' => route('register.second.save'), 'method' => 'post', 'class' => 'clearfix common', 'data-next' => route('register.third'))) !!}
                        <table class="table" data-idx="{{ count($eslExp) ? count($eslExp) - 1  : 0 }}">
                            <thead>
                                <tr class="success">
                                    <th>ESL Company</th>
                                    <th>Position</th>
                                    <th>Location</th>
                                    <th style="width:12%">Start</th>
                                    <th style="width:12%">End</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(empty($eslExp))
                                <tr>
                                    <td> {!! Form::text("exp[0][name]", null, ['class' => 'form-control lp', 'data-name' => 'exp[idx][name]']) !!}</td>
                                    <td> {!! Form::text("exp[0][position]", null, ['class' => 'form-control lp', 'data-name' => 'exp[idx][position]']) !!}</td>
                                    <td> {!! Form::text("exp[0][location]", null, ['class' => 'form-control lp', 'data-name' => 'exp[idx][location]']) !!}</td>
                                    <td> {!! Form::text("exp[0][start]", null, ['class' => 'form-control lp datepicker', 'data-name' => 'exp[idx][start]']) !!}</td>
                                    <td> 
                                        {!! Form::text("exp[0][end]", null, ['class' => 'form-control lp datepicker', 'data-name' => 'exp[idx][end]']) !!}
                                        {!! Form::hidden("exp[0][experience_type]", 'ESL', ['class' => 'constant', 'data-name' => 'exp[idx][experience_type]']) !!}
                                    </td>
                                    <td  style="vertical-align:middle"><a class="text-danger remove-line"><i class="glyphicon glyphicon-remove"></i></a></td>
                                </tr>
                                @endif
                                @foreach ($eslExp as $key => $exp)
                                <tr>
                                    <td> {!! Form::text("exp[{$key}][name]", $exp->name, ['class' => 'form-control lp', 'data-name' => 'exp[idx][name]']) !!}</td>
                                    <td> {!! Form::text("exp[{$key}][position]", $exp->position, ['class' => 'form-control lp', 'data-name' => 'exp[idx][position]']) !!}</td>
                                    <td> {!! Form::text("exp[{$key}][location]", $exp->location, ['class' => 'form-control lp', 'data-name' => 'exp[idx][location]']) !!}</td>
                                    <td> {!! Form::text("exp[{$key}][start]", $exp->start, ['class' => 'form-control lp datepicker', 'data-name' => 'exp[idx][start]']) !!}</td>
                                    <td> 
                                        {!! Form::text("exp[{$key}][end]", $exp->end, ['class' => 'form-control lp datepicker', 'data-name' => 'exp[idx][end]']) !!}
                                        {!! Form::hidden("exp[{$key}][experience_type]", 'ESL', ['class' => 'constant', 'data-name' => 'exp[idx][experience_type]']) !!}
                                        {!! Form::hidden("exp[{$key}][id]", $exp->id, ['class' => 'optional', 'data-name' => 'exp[idx][id]']) !!}
                                    </td>
                                    <td  style="vertical-align:middle"><a class="text-danger remove-line"><i class="glyphicon glyphicon-remove"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody> 
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="border:0"><a class="btn btn-default new-line" data-callback="initDatepicker">Add more experience</a></td>
                                </tr>
                            </tfoot>
                        </table>
                        <table class="table" data-idx="{{ count($ccExp) ? count($ccExp) - 1  : 200 }}">
                            <thead>
                                <tr class="success">
                                    <th>Call Center Company</th>
                                    <th>Position</th>
                                    <th>Location</th>
                                    <th style="width:12%">Start</th>
                                    <th style="width:12%">End</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(empty($ccExp))
                                <tr>
                                    <td> {!! Form::text("exp[200][name]", null, ['class' => 'form-control lp', 'data-name' => 'exp[idx][name]']) !!}</td>
                                    <td> {!! Form::text("exp[200][position]", null, ['class' => 'form-control lp', 'data-name' => 'exp[idx][position]']) !!}</td>
                                    <td> {!! Form::text("exp[200][location]", null, ['class' => 'form-control lp', 'data-name' => 'exp[idx][location]']) !!}</td>
                                    <td> {!! Form::text("exp[200][start]", null, ['class' => 'form-control lp datepicker', 'data-name' => 'exp[idx][start]']) !!}</td>
                                    <td> 
                                        {!! Form::text("exp[200][end]", null, ['class' => 'form-control lp datepicker', 'data-name' => 'exp[idx][end]']) !!}
                                        {!! Form::hidden("exp[200][experience_type]", 'CC', ['class' => 'constant', 'data-name' => 'exp[idx][experience_type]']) !!}
                                    </td>
                                    <td  style="vertical-align:middle"><a class="text-danger remove-line"><i class="glyphicon glyphicon-remove"></i></a></td>
                                </tr>
                                @endif
                                @foreach ($ccExp as $key => $exp)
                                <tr>
                                    <td> {!! Form::text("exp[". (200 + $key) ."][name]", $exp->name, ['class' => 'form-control lp', 'data-name' => 'exp[idx][name]']) !!}</td>
                                    <td> {!! Form::text("exp[". (200 + $key) ."][position]", $exp->position, ['class' => 'form-control lp', 'data-name' => 'exp[idx][position]']) !!}</td>
                                    <td> {!! Form::text("exp[". (200 + $key) ."][location]", $exp->location, ['class' => 'form-control lp', 'data-name' => 'exp[idx][location]']) !!}</td>
                                    <td> {!! Form::text("exp[". (200 + $key) ."][start]", $exp->start, ['class' => 'form-control lp datepicker', 'data-name' => 'exp[idx][start]']) !!}</td>
                                    <td> 
                                        {!! Form::text("exp[". (200 + $key) ."][end]", $exp->end, ['class' => 'form-control lp datepicker', 'data-name' => 'exp[idx][end]']) !!}
                                        {!! Form::hidden("exp[". (200 + $key) ."][experience_type]", 'CC', ['class' => 'constant', 'data-name' => 'exp[idx][experience_type]']) !!}
                                        @if(isset($exp->id) && $exp->id)
                                            {!! Form::hidden("exp[". (200 + $key) ."][id]", $exp->id, ['class' => 'optional', 'data-name' => 'exp[idx][id]']) !!}
                                        @endif
                                    </td>
                                    <td  style="vertical-align:middle"><a class="text-danger remove-line" ><i class="glyphicon glyphicon-remove"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody> 
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="border:0"><a class="btn btn-default new-line " data-callback="initDatepicker">Add more experience</a></td>
                                </tr>
                            </tfoot>
                        </table>
                        <button type="submit" class="btn btn-success pull-right">Save</button>
                    {!! Form::close() !!}
            </fieldset>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bstimepicker.min.js') }}"></script>
<script>
    function initDatepicker($el){
        console.log('lol');
        $el.closest('tbody').find('tr:last .datepicker').datetimepicker({
            format: 'MM/DD/YYYY',
        });
    }
    $(document).ready(function(){
        $('.datepicker').datetimepicker({
            format: 'MM/DD/YYYY',
        });
    })
</script>
@endpush
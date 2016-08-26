@extends('blocks.registration.master')
@section('partTwoCurrent', 'active')

@section('form')
 <fieldset>
        <legend class="text-center" style="border-bottom:0;margin-bottom:30px">Let's add your work experience<br><small>Please input your work experience as a teacher.</small></legend>
        {!! Form::open(array('url' => route('register.second.save'), 'method' => 'post', 'id' => 'registration-second', 'class' => 'clearfix', 'data-next' => route('register.third'))) !!}
            <table class="table" data-idx="0">
                <thead>
                    <tr class="success">
                        <th>ESL Company</th>
                        <th>Position</th>
                        <th>Location</th>
                        <th style="width:12%">Years</th>
                        <th style="width:12%">Months</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> {!! Form::text('esl[0][name]', null, ['class' => 'form-control', 'data-name' => 'esl[idx][name]']) !!}</td>
                        <td> {!! Form::text('esl[0][position]', null, ['class' => 'form-control', 'data-name' => 'esl[idx][position]']) !!}</td>
                        <td> {!! Form::text('esl[0][location]', null, ['class' => 'form-control', 'data-name' => 'esl[idx][location]']) !!}</td>
                        <td> {!! Form::text('esl[0][years]', null, ['class' => 'form-control', 'data-name' => 'esl[idx][years]']) !!}</td>
                        <td> {!! Form::text('esl[0][months]', null, ['class' => 'form-control', 'data-name' => 'esl[idx][months]']) !!}</td>
                        <td  style="vertical-align:middle"><a class="text-danger remove-line"><i class="glyphicon glyphicon-remove"></i></a></td>
                    </tr>
                </tbody> 
                <tfoot>
                    <tr>
                        <td colspan="5" style="border:0"><a class="btn btn-default new-line">Add more experience</a></td>
                    </tr>
                </tfoot>
            </table>
            <table class="table" data-idx="0">
                <thead>
                    <tr class="success">
                        <th>Call Center Company</th>
                        <th>Position</th>
                        <th>Location</th>
                        <th style="width:12%">Years</th>
                        <th style="width:12%">Months</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> {!! Form::text('cc[0][name]', null, ['class' => 'form-control', 'data-name' => 'cc[idx][name]']) !!}</td>
                        <td> {!! Form::text('cc[0][position]', null, ['class' => 'form-control', 'data-name' => 'cc[idx][position]']) !!}</td>
                        <td> {!! Form::text('cc[0][location]', null, ['class' => 'form-control', 'data-name' => 'cc[idx][location]']) !!}</td>
                        <td> {!! Form::text('cc[0][years]', null, ['class' => 'form-control', 'data-name' => 'cc[idx][years]']) !!}</td>
                        <td> {!! Form::text('cc[0][months]', null, ['class' => 'form-control', 'data-name' => 'cc[idx][months]']) !!}</td>
                        <td  style="vertical-align:middle"><a class="text-danger remove-line"><i class="glyphicon glyphicon-remove"></i></a></td>
                    </tr>
                </tbody> 
                <tfoot>
                    <tr>
                        <td colspan="5" style="border:0"><a class="btn btn-default new-line">Add more experience</a></td>
                    </tr>
                </tfoot>
            </table>
            <button type="submit" class="btn btn-success pull-right">Save</button>
        {!! Form::close() !!}
</fieldset>
@endsection
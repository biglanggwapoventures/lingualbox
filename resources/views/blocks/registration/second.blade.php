@extends('blocks.registration.master')
@section('partTwoCurrent', 'active')

@section('form')
 <fieldset>
        <legend class="text-center" style="border-bottom:0;margin-bottom:30px">Let's add your work experience<br><small>Please input your work experience as a teacher.</small></legend>
        {!! Form::open(array('url' => route('register.second.save'), 'method' => 'post', 'id' => 'registration-second', 'class' => 'clearfix', 'data-next' => route('register.third'))) !!}
            <table class="table">
                <thead>
                    <tr class="success">
                        <th>ESL Company</th>
                        <th>Position</th>
                        <th>Location</th>
                        <th style="width:12%">Months</th>
                        <th style="width:12%">Years</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" /></td>
                        <td><input type="text" class="form-control" /></td>
                        <td><input type="text" class="form-control" /></td>
                        <td><input type="text" class="form-control" /></td>
                        <td><input type="text" class="form-control" /></td>
                        <td  style="vertical-align:middle"><a class="text-danger">x</a></td>
                    </tr>
                </tbody> 
                <tfoot>
                    <tr>
                        <td colspan="5" style="border:0"><a class="btn btn-default">Add more experience</a></td>
                    </tr>
                </tfoot>
            </table>
            <button type="submit" class="btn btn-success pull-right">Save</button>
        {!! Form::close() !!}
</fieldset>
@endsection
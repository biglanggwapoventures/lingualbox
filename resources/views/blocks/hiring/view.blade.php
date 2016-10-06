@extends('profile')

@section('profile-content')

<style type="text/css">
    table th{
        vertical-align:middle!important;
    }
</style>

<div class="panel panel-default">
    
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>Needed Teachers</h2>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">ID</th>
                <th rowspan="2">Date</th>
                <th colspan="4" class="text-center">Schedule</th>
                <th rowspan="2">Requested By</th>
                <th rowspan="2">Status</th>
            </tr>
            <tr>
                <th>Morning</th>
                <th>Afternoon</th>
                <th>Evening</th>
                <th>Midnight</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hiring AS $row)
                <tr >
                    <td><a class="update" data-toggle="modal" data-target="#manage">{{ $row->id }}</a></td>
                    <td>{{ $row->date_requested }}</td>
                    <td >{{ $row->morning }}</td>
                    <td >{{ $row->afternoon }}</td>
                    <td>{{ $row->evening }}</td>
                    <td>{{ $row->midnight }}</td>
                    <td>{{ $row->requestor->fullName() }}</td>
                    <td>{!! $row->isFulfilled() ? '<span class="text-success">FULFILLED</span>' : '<span class="text-warning">PENDING</span>' !!} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
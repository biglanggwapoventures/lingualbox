@extends('profile')

@section('profile-content')
<style>
    .nav {
        display: inline-block;
        float: none;
    }
</style>
<div class="panel panel-default">
    
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>Check Applicant Written Exams</h2>
        </div>
         <!-- Table -->
        <div class="text-center">
            <ul class="nav nav-pills text-center" style="margin-bottom:10px">
                <li role="presentation" class="{{ Route::currentRouteNamed('written.exam.list') && !$session ? 'active' : '' }}">
                    <a href="{{ route('written.exam.list', ['schedule' => 'all']) }}">All</a>
                </li>
                <li role="presentation" class="{{ Route::currentRouteNamed('written.exam.list') && $session == 'MORNING' ? 'active' : '' }}">
                    <a href="{{ route('written.exam.list', ['schedule' => 'MORNING']) }}">Morning</a>
                </li>
                <li role="presentation" class="{{ Route::currentRouteNamed('written.exam.list') && $session == 'AFTERNOON' ? 'active' : '' }}">
                    <a href="{{ route('written.exam.list', ['schedule' => 'AFTERNOON']) }}">Afternoon</a>
                </li>
                <li role="presentation" class="{{ Route::currentRouteNamed('written.exam.list') && $session == 'EVENING' ? 'active' : '' }}">
                    <a href="{{ route('written.exam.list', ['schedule' => 'EVENING']) }}">Evening</a>
                </li>
                <li role="presentation" class="{{ Route::currentRouteNamed('written.exam.list') && $session == 'MIDNIGHT' ? 'active' : '' }}">
                    <a href="{{ route('written.exam.list', ['schedule' => 'MIDNIGHT']) }}">Midnight</a>
                </li>
            </ul>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    @if(!$session)
                        <th>Shift</th>
                    @endif
                    <th>Date</th>
                    <th>Gender</th>
                    <th>Demo Sched</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($items))
                    @foreach($items AS $row)
                        <tr>
                            <td>{{ $row->applicant }}</td>
                            @if(!$session)
                                <td>{{ $row->work_schedule }}</td>
                            @endif
                            <td>{{ date_create_immutable($row->date)->format('m/d/Y h:i A') }}</td>
                            <td>{{ $row->gender }}</td>
                            <td>{{ "{$row->demo_day} {$row->demo_time}" }}</td>
                            <td><a href="{{ route('written.exam.view', ['id' => $row->id ]) }}">Check</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection

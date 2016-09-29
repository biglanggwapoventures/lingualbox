@extends('profile')

@section('profile-content')

@push('css')
<link rel="stylesheet" href="{{ asset('css/x-editable.css') }}">
@endpush


<div class="panel panel-default">
    
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>Hired Summary</h2>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-condensed table-striped" data-url="{{ route('hired.update') }}" id="hired">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date Hired</th>
                            <th>Shift</th>
                            <th>Working Days</th>
                            <th>Time Schedule</th>
                            <th>Rate</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users AS $row)
                            <tr data-pk="{{ $row->user_id }}">
                                <td><a href="{{ route('profile.view', ['id' => $row->user_id]) }}">{{ $row->user->fullname() }}</a></td>
                                <td>{{ date_create_immutable($row->hired_at)->format('F d, Y')  }}</td>
                                <td><a class="editable shift" data-value="{{ $row->shift  }}"></a></td>
                                <td><a class="editable workdays" data-value="{{ implode(',', is_array($row->work_days) ? $row->work_days : []) }}"></a></td>
                                <td><a class="editable time"  data-value="{{ $row->time_schedule  }}"></a></td>
                                <td><a class="editable rate" data-value="{{ $row->rate  }}"></a></td>
                                <td><a class="editable status" data-value="{{ $row->status  }}"></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script type="text/javascript" src="{{ asset('js/x-editable.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/update-hired-status.js') }}"></script>
@endpush
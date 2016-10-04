@extends('profile')

@section('profile-content')


<div class="panel panel-default">
    
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>Applicants Summary</h2>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table  table-striped" >
                    <thead>
                        <tr>
                            <th>Applicant</th>
                            <th>Reading</th>
                            <th>Written</th>
                            <th>Demo Class</th>
                            <th>Orientation</th>
                            <th>Requirements</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applicants AS $row)
                            <tr data-update-url="{{ route('applicants.update', ['id' => $row->id]) }}">
                                @php
                                    $status = $row->phaseStatus();
                                @endphp
                                 <td> <a href="{{ route('profile.view', ['id' => $row->id]) }}">{{ $row->fullname() }}</a></td>
                                <td>
                                    {{ $status['READING'] }}
                                    <span class="label label-default" style="display:block">{{ $row->latestReadingExam()->exists() ? $row->latestReadingExam->datetime_started : 'N/A' }}</span>
                                </td>
                                <td>
                                    {{ $status['WRITTEN'] }}
                                    <span class="label label-default" style="display:block">{{ $row->latestWrittenExam()->exists() ? $row->latestWrittenExam->datetime_started : 'N/A' }}</span>
                                </td>
                                <td>
                                    @if($status['DEMO'] !== '-')
                                        {!! 
                                            Form::select(
                                                '', 
                                                ['PENDING' => 'PENDING', 'PASSED' => 'PASSED', 'FAILED' => 'FAILED'], 
                                                $status['DEMO'],
                                                ['class' => 'form-control input-sm', 'data-update' => 'DEMO']
                                            ) 
                                        !!}
                                        <span class="label label-default">{{ $row->demoClass()->exists() ? $row->demoClass->updated_at : '' }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($status['ORIENTATION'] !== '-')
                                        {!! 
                                            Form::select(
                                                '', 
                                                ['PENDING' => 'PENDING', 'PASSED' => 'PASSED', 'FAILED' => 'FAILED'], 
                                                $status['ORIENTATION'],
                                                ['class' => 'form-control input-sm', 'data-update' => 'ORIENTATION']
                                            ) 
                                        !!}
                                        <span class="label label-default">{{ $row->orientation()->exists() ? $row->orientation->updated_at : '' }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($status['REQUIREMENTS'] !== '-')
                                        {!! 
                                            Form::select(
                                                '', 
                                                ['PENDING' => 'PENDING', 'PASSED' => 'PASSED', 'FAILED' => 'FAILED'], 
                                                $status['REQUIREMENTS'],
                                                ['class' => 'form-control input-sm', 'data-update' => 'REQUIREMENTS']
                                            ) 
                                        !!}
                                        <span class="label label-default">{{ $row->requirement()->exists() ? $row->requirement->updated_at : '' }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $status['OVERALL'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('profile-js')
<script type="text/javascript" src="{{ asset('js/update-applicant-status.js') }}"></script>
@endpush
@extends('profile')

@section('profile-content')



<div class="panel panel-default">
    
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>Applicants Summary</h2>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-condensed table-striped" >
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
                                <td>{{ $row->fullname() }}</td>
                                <td>{{ $row->phaseStatus('READING') }}</td>
                                <td>{{ $row->phaseStatus('WRITTEN') }}</td>
                                <td>
                                    @if($row->phaseStatus('DEMO') !== '-')
                                        {!! 
                                            Form::select(
                                                '', 
                                                ['PENDING' => 'PENDING', 'PASSED' => 'PASSED', 'FAILED' => 'FAILED'], 
                                                $row->phaseStatus('DEMO'),
                                                ['class' => 'form-control input-sm', 'data-update' => 'DEMO']
                                            ) 
                                        !!}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($row->phaseStatus('ORIENTATION') !== '-')
                                        {!! 
                                            Form::select(
                                                '', 
                                                ['PENDING' => 'PENDING', 'PASSED' => 'PASSED', 'FAILED' => 'FAILED'], 
                                                $row->phaseStatus('ORIENTATION'),
                                                ['class' => 'form-control input-sm', 'data-update' => 'ORIENTATION']
                                            ) 
                                        !!}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($row->phaseStatus('REQUIREMENTS') !== '-')
                                        {!! 
                                            Form::select(
                                                '', 
                                                ['PENDING' => 'PENDING', 'PASSED' => 'PASSED', 'FAILED' => 'FAILED'], 
                                                $row->phaseStatus('REQUIREMENTS'),
                                                ['class' => 'form-control input-sm', 'data-update' => 'REQUIREMENTS']
                                            ) 
                                        !!}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $row->phaseStatus('OVERALL') }}</td>
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
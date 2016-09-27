@extends('profile')

@section('profile-content')

<div class="panel panel-default">
    
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>Report</h2>
        </div>
        <canvas id="myChart" data-hired="{{ json_encode($report['hired']) }}" data-failed="{{ json_encode($report['failed']) }}"></canvas>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript" src="{{ asset('js/chart.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/report.js') }}"></script>
@endpush
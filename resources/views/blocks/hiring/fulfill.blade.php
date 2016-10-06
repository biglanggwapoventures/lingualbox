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
            <h2>Teacher Fulfills</h2>
        </div>
        <div class="btn-toolbar text-center">
            <a data-toggle="modal" data-target="#manage" class="btn btn-primary pull-right" data-mode="create"  data-store-url="{{ route('fulfill-teachers.store') }}">
                <i class="fa fa-plus"></i> Add new fulfillment
            </a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">ID</th>
                <th rowspan="2">Request ID</th>
                <th rowspan="2">Date Fulfilled</th>
                <th colspan="4" class="text-center">Schedule</th>
                <th rowspan="2">Fulfilled By</th>
                <th rowspan="2"></th>
            </tr>
            <tr>
                <th>Morning</th>
                <th>Afternoon</th>
                <th>Evening</th>
                <th>Midnight</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fulfillments AS $row)
                <tr data-update-url="{{ route('fulfill-teachers.update', ['id' => $row->id]) }}" data-delete-url="{{ route('fulfill-teachers.destroy', ['id' => $row->id]) }}" data->
                    <td><a class="update" data-toggle="modal" data-target="#manage">{{ $row->id }}</a></td>
                    <td data-request-id="{{ $row->request_id }}" >{{ $row->request_id }}</td>
                    <td>{{ $row->date_fulfilled }}</td>
                    <td data-morning="{{ $row->morning }}">{{ $row->morning }}</td>
                    <td data-afternoon="{{ $row->afternoon }}">{{ $row->afternoon }}</td>
                    <td data-evening="{{ $row->evening }}">{{ $row->evening }}</td>
                    <td data-midnight="{{ $row->midnight }}">{{ $row->midnight }}</td>
                    <td>{{ $row->fulfilledBy->fullName() }}</td>
                    <td><a data-toggle="modal" data-target="#confirm-remove" class="btn btn-danger btn-xs remove"><i class="fa fa-times"></i> Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div class="modal fade" id="manage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      {!! Form::open(['url' => '', 'class' => 'form-horizontal common', 'id' => 'form', 'method' => 'PUT']) !!}
      <div class="modal-body">
        <div class="form-group">
            <label class="col-sm-4 control-label">Request ID</label>
            <div class="col-sm-6">
                {!! Form::select('request_id', $unfulfilledForDropdown, null, ['class' => 'form-control', 'placeholder' => 'Select a request id']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Morning</label>
            <div class="col-sm-6">
                {!! Form::text('morning', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Afternoon</label>
            <div class="col-sm-6">
                {!! Form::text('afternoon', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Evening</label>
            <div class="col-sm-6">
                {!! Form::text('evening', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Midnight</label>
            <div class="col-sm-6">
                {!! Form::text('midnight', null, ['class' => 'form-control']) !!}
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<div class="modal fade" id="confirm-remove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
  <div class="modal-dialog  modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel2">Confirm deletion</h4>
      </div>
      {!! Form::open(['url' => '', 'class' => 'form-horizontal common', 'id' => 'xform', 'method' => 'DELETE']) !!}
      <div class="modal-body">
        <p class="lead text-center">Are you sure you want to delete this item?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection

@push('profile-js')
<script src="{{ asset('js/teacher-fulfills.js') }}" type="text/javascript"></script>
@endpush
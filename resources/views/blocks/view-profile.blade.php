@extends('profile')

@section('profile-content')

<style>
   #i tbody > tr > td:nth-child(2){
        font-weight:bold;
    }
     #ii tbody > tr > td:nth-child(2){
        font-weight:normal;
    }
</style>
<div class="panel panel-default">
    
     <div class="panel-body">
        <div class="page-header text-center" style="margin-top:0">
            <h2>View Profile</h2>
        </div>
        <div class="row">
           
        </div>
        <div class="row">
             
            <div class="col-sm-9">
                 <table class="table table-bordered table-condensed" id="i">
                    <tbody>
                        <tr class="active"><td colspan="2" class="text-center">BASIC INFORMATION</td></tr>
                        <tr>
                            <td>Full Name</td>
                            <td>{{ $user->fullname() }}</td>
                        </tr>
                        <tr>
                            <td>Birthday</td>
                            <td>{{ date_create_immutable($user->birthdate)->format('F d, Y') }}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{ $user->gender }}</td>
                        </tr>
                        <tr>
                            <td>Marital Status</td>
                            <td>{{ $user->marital_status }}</td>
                        </tr>
                        <tr>
                            <td>Mobile Number</td>
                            <td>{{ $user->mobile_number }}</td>
                        </tr>
                        <tr>
                            <td>Email Address</td>
                            <td>{{ $user->email_address }}</td>
                        </tr>
                        <tr>
                            <td>Skype account</td>
                            <td>{{ $user->skype_account }}</td>
                        </tr>
                        <tr>
                            <td>Street Address</td>
                            <td>{{ $user->street_address }}</td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>{{ $user->city }}</td>
                        </tr>
                        <tr>
                            <td>Province</td>
                            <td>{{ $user->province }}</td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>{{ $user->country }}</td>
                        </tr>
                        <tr class="active"><td colspan="2" class="text-center">EXPERIENCE</td></tr>
                        @if($user->experiences()->exists())
                            <td colspan="2">
                                <table class="table" id="ii">
                                <thead><tr><th>Type</th><th>Company</th><th>Postion</th><th>Duration</th></tr></thead>
                                    @foreach($user->experiences AS $exp)
                                        <tr>
                                            <td>{{ $exp->experience_type === 'CC' ? 'Call Center' : 'ESL' }}</td>
                                            <td>{{ $exp->name }}</td>
                                            <td>{{ $exp->position }}</td>
                                            <td>{{ "{$exp->start} - {$exp->end}" }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        @else
                        <td colspan="2" class="text-center">-</td>
                        @endif
                        <tr class="active"><td colspan="2" class="text-center">UPLOADS</td></tr>
                        @if($user->preference()->exists())
                        <tr>
                            <td>Internet speed screen shot</td>
                            <td><a data-toggle="modal" data-target="#uploads" data-view="speedtest" data-title="View speedtest screenshot" data-src="{{ asset("uploads/{$user->id}/speedtest/{$user->preference->internet_speed_screenshot_filename}") }}">View photo</a></td>
                        </tr>
                        <tr>
                            <td>TEFL Certificate</td>
                            <td>
                                @if($user->preference->tefl_certificate_filename)
                                    <a data-toggle="modal" data-target="#uploads" data-view="tesol" data-title="View TEFL Certificate" data-src="{{ asset("uploads/{$user->id}/certificates/{$user->preference->tefl_certificate_filename}") }}"> View photo</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>TESOL Certificate</td>
                            <td>
                                @if($user->preference->tesol_certificate_filename)
                                    <a data-toggle="modal" data-target="#uploads" data-view="tefl" data-title="View TESOL Certificate" data-src="{{ asset("uploads/{$user->id}/certificates/{$user->preference->tesol_certificate_filename}") }}">View photo</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                         @else
                        <td colspan="2" class="text-center">-</td>
                        @endif
                    </tbody>

                </table>
            </div>
            <div class="col-sm-3">
                <img src="{{ $user->displayPhoto() }}" alt="" class="img-responsive img-thumbnail">
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="uploads" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
        
      </div>
      <div class="modal-body">
       <img src="" alt="" class="img-responsive center-block">
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@push('profile-js')
<script type="text/javascript">
    $('#uploads').on('show.bs.modal', function(e){
        var target = $(e.relatedTarget);
        $(this).find('img').attr('src', target.data('src'));
        $(this).find('.modal-title').text(target.data('title'));
    });
</script>
@endpush
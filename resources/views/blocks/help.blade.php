@extends('layouts.master')
@push("css")
<link rel="stylesheet" type="text/css" href="{{asset("css/help.css")}}">
@endpush
@section('title', 'Help - LingualBox')

@section('content')
    @include('blocks.navbar')

     <!-- CODE GOES HERE -->

     <div class="container-fluid ">
     	<h1 class="text-center titleHelp">Frequently Asked Questions</h1>
     </div>

     <div class="container">
     	<div class="row">
     		<div class="col-lg-6 col-md-6 col-sm-6"> 
     			<h3 class="headerHelp">Application</h3>
     			<hr class="helpLine" />
	
     			<div >
     				<h5 class="switch questionHelp" id="q-1">+ How do I apply?</h5>
     				<p class="content answerHelp" id="a-1" style="display:none">- Click "Apply Now!" to apply online. Fill out the registration form,verify your email address by clicking the link sent to you via email and follow  the steps on your dashboard.</p>
     			</div>
     			<hr class="helpLine" />
	
     			<div>
     				<h5  class="switch questionHelp" id="q-2">+ Can undergraduate students apply?</h5>
     				<p class="content answerHelp" id="a-2" style="display:none">- Unfortunately, no. We need teachers dedicated on Teaching.</p>
     			</div>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ How long is the application process?</h5>
     				<p class="content answerHelp">- It mainly depends on the applicant's availability. It usually takes one week but it can be finished in as fast as three days.</p>
     			</div>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ Can I apply even though I am in another country?</h5>
     				<p class="content answerHelp">- Yes, as long as you have a good internet connection and can qualify in our application assessment.</p>
     			</div>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ I am not a Filipino, can I apply?</h5>
     				<p class="content answerHelp">- No, we are just currently hiring Filipino English teacher.</p>
     			</div>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ I missed my interview schedule, what should I do?</h5>
     				<p class="content answerHelp">- You should receive an e-mail from our recruitment team. Please respond to it so you can reschedule your interview.</p>
     			</div>
     		</div>
     	</div>

     	<div class="row">
     		<div class="col-lg-6">
     			<h3 class="headerHelp">Requirements</h3>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ What are the requirements to become a LingualBox tutor?</h5>
     				<div class="content answerHelp">
     				<p >- To become a LingualBox tutor, you need to meet the initial requirements below:
     					<ul>
								<li>Must be at least 18 years old</li>
								<li>Must have access to a stable Internet connection minimum of 0.7mbps</li>
								<li>Must be a Bachelor Degree Holder</li>
								<li>Must have at least 6 months of teaching experience</li>
							</ul>
						</p>
						</div>
     			</div>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ Do I need to have a teaching experience to qualify?</h5>
     				<p class="content answerHelp">- Yes, we don't have trainors to train our newly hired applicant but rest assured that there will be an orientation before you start teaching.</p>
     			</div>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ Is there any age limit?</h5>
     				<p class="content answerHelp">- As long as you are 18 years old and above and a Bachelor Degree Holder, you are welcome to apply in our company.</p>
     			</div>
     		</div>
     	</div>

     	<div class="row">
     		<div class="col-lg-6">
     			<h3 class="headerHelp">Start Teaching</h3>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ Who will be I teaching?</h5>
     			</div>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ Who will be I teaching?</h5>
     			</div>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ How do I conduct lesson?</h5>
     			</div>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ How long is the usual lesson?</h5>
     			</div>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ Are lesson modules provided for?</h5>
     			</div>
     			<hr class="helpLine" />
	
     			<div>
     				<h5 class="switch questionHelp">+ How to get my salary?</h5>
     			</div>
     		</div>	
     	</div>

     	<div class="row">
     		<div class="col-lg-6">
     			<p>Contact Us</p>
     		</div>
     	</div>

     </div>




@endsection

@push("js")
<script>
	$(document).ready(function(){
		$(".switch").click(function() {
			var qID = $(this).attr('id');
			var num = qID.split('-')[1];
			$("#a-" + num).slideToggle();
		});
	});

</script>
@endpush
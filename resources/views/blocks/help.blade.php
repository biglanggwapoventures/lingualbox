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

    <div class="row">
    <div class="container">
    	
     		<div class="col-lg-6 col-md-6 col-sm-6">
     			<div class="row">
     			 
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
     					<h5 class="switch questionHelp" id="q-3">+ How long is the application process?</h5>
     					<p class="content answerHelp" id="a-3" style="display:none">- It mainly depends on the applicant's availability. It usually takes one week but it can be finished in as fast as three days.</p>
     				</div>
     				<hr class="helpLine" />
		
     				<div>
     					<h5 class="switch questionHelp" id="q-4">+ Can I apply even though I am in another country?</h5>
     					<p class="content answerHelp" id="a-4" style="display:none">- No, our teachers must be staying here in the Philippines.</p>
     				</div>
     				<hr class="helpLine" />
		
     				<div>
     					<h5 class="switch questionHelp" id="q-5">+ I am not a Filipino, can I apply?</h5>
     					<p class="content answerHelp" id="a-5" style="display:none">- No, we are just currently hiring Filipino English teacher.</p>
     				</div>
     				<hr class="helpLine" />
		
     				<div>
     					<h5 class="switch questionHelp" id="q-6">+ I missed my interview schedule, what should I do?</h5>
     					<p class="content answerHelp" id="a-6" style="display:none">- You should receive an e-mail from our recruitment team. Please respond to it so you can reschedule your interview.</p>
     				</div>
     			
     			</div>
	
     			<div class="row">
     				<h3 class="headerHelp">Requirements</h3>
     				<hr class="helpLine" />
			
     				<div>
     					<h5 class="switch questionHelp" id="q-7">+ What are the requirements to become a LingualBox tutor?</h5>
     					<div class="content answerHelp" id="a-7" style="display:none">
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
     					<h5 class="switch questionHelp" id="q-8">+ Do I need to have a teaching experience to qualify?</h5>
     					<p class="content answerHelp" id="a-8" style="display:none">- Yes, we don't have trainors to train our newly hired applicant but rest assured that there will be an orientation before you start teaching.</p>
     				</div>
     				<hr class="helpLine" />
			
     				<div>
     					<h5 class="switch questionHelp" id="q-9">+ Is there any age limit?</h5>
     					<p class="content answerHelp" id="a-9" style="display:none">- As long as you are 18 years old and above and a Bachelor Degree Holder, you are welcome to apply in our company.</p>
     				</div>
     			</div>
		
     			<div class="row">
     				<h3 class="headerHelp">Start Teaching</h3>
     				<hr class="helpLine" />
			
     				<div>
     					<h5 class="switch questionHelp" id="q-10">+ Who will be I teaching?</h5>
     					<p class="content answerHelp" id="a-10" style="display:none">- LingualBox is an international school around the globe so you can meet students from any non-English speaking countries.</p>
     				</div>
     				<hr class="helpLine" />
			
     				<div>
     					<h5 class="switch questionHelp" id="q-11">+ How do I conduct lesson?</h5>
     					<p class="content answerHelp" id="a-11" style="display:none">- LingualBox is an international school around the globe so you can meet students from any non-English speaking countries.</p>
     				</div>
     				<hr class="helpLine" />
			
     				<div>
     					<h5 class="switch questionHelp" id="q-12">+ How long is the usual lesson?</h5>
     					<p class="content answerHelp" id="a-12" style="display:none">- All lessons are conducted through Skype; hence, tutors must need to learn how to use it.</p>
     				</div>
     				<hr class="helpLine" />
			
     				<div>
     					<h5 class="switch questionHelp" id="q-13">+ Are lesson modules provided?</h5>
     					<p class="content answerHelp" id="a-13" style="display:none">- LingualBox provides lesson material for our teachers. You can use different varieties of lesson and teachers can also use other materials if they find the materials provided insufficient.</p>
     				</div>
     				<hr class="helpLine" />
			
     				<div>
     					<h5 class="switch questionHelp" id="q-14">+ How to get my salary?</h5>
     					<p class="content answerHelp" id="a-14" style="display:none">- You have to have your Paypal account connected to your Bank Account to get your salary.</p>
     				</div>
     			</div>
     		</div>
		
     		<div class="col-lg-6">
     			<div class="row">
     				<div class="col-md-offset-2">
     					<p class="contactHelp">Contact Us</p>
     					<p class="detailHelp">Don’t See Your Question Answered? Contact <br/>our support team.</p>
     					<p class="emailHelp">hr@lingualbox.com</p>
     				</div>
     			</div>
     		</div>

     	</div>

          <div class="row"> 
                <footer class="ourfooterAbout">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="text-center headerFooter">Our site</h5>
                            <p class="text-center sites"><a href="{{ route('register.first') }}">Apply now!</a></p>
                            <p class="text-center"><a href="{{ route('about-us') }}">About us</a></p>
                        </div>
                
                        <div class="col-md-4">
                            <h5 class="text-center headerFooter">Support</h5>
                            <p class="text-center"><a href="{{ route('help') }}">Help</a></p>
                            <p class="text-center">hr@lingualbox.com</p>
                        </div>
                
                        <div class="col-md-4">
                            <h5 class="text-center headerFooter">Legal</h5>
                            <p class="text-center">Privacy Policy</p>
                        </div>
                    </div>
            
                    <div class="footer-divider title-divider--gray"></div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-center logoFooter">© LingualBox, Inc.</h5>
                        </div>
                    </div>
                </footer>
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
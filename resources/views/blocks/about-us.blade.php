@extends('layouts.master')
@push("css")
	<link rel="stylesheet" type="text/css" href="{{asset("css/about.css")}}">
@endpush
@section('title', 'About us - LingualBox')

@section('content')
    @include('blocks.navbar')

    <!- CODE GOES HERE ->
    <div class="container-fluid">
        <div class="row">
            <div class="container">
            	
            	<div class="col-lg-12">
            		<h1 class="text-center titleAbout">Our Story</h1>
            		<div class="title-divider title-divider--green"></div>
        
            		<div class="row">
            			<div class="col-lg-offset-2 col-lg-8">
            				<p class="paraAbout">LingualBox is an online English language school offering 1:1 Live English classes online to students all over the world. <br/><br/>
            					Our founder Atsuhiro Teshima had been struggling with learning to speak English in Japan because of the lack of opportunities and teaching style of high school in Japan which too lean to Grammar and Reading.<br/><br/> 
            					On his backpacking trip in Southeast Asia, he went through many sour experiences because of the lacking of speaking skill. 
            					After the trip, he started learning at an online English language school which Filipino tutors are teaching. 
            					Although it helped him to become comfortable with speaking English, most schools he tried had no curriculum fit to learner's levels and it makes him to realise it would not work well for most learners. <br/><br/>
            					LingualBox was started for solving this problem. Our goal is to offer more effective way to learn English by offering effective curriculums fit to each student's needs through technology and more human interactive way. <br/><br/>
            					Alongside running the website, we noticed that most schools are teaching English only to Asian countries especially China, Japan and South Korea. 
            					We start taking the opportunity to offering the classes to students globally. <br/><br/>
            					Currently LingualBox is offering the service in 6 languages and students from more than 50 countries are learning with us. </p>
        
            					<img class="img-responsive center-block teacherAbout" src="{{ asset('img/map-org.png') }}" alt="Have a flexible time" width="500" height="500"/>	
            					<hr class="lineHelp" />
            			</div>		
        
            		</div>
                    <div class="row">
                        <h1 class="text-center titleAbout">Message From the CEO</h1>
                        <div class="title-divider title-divider--green"></div>
        
                        <div class="row">
                            <div class="col-lg-offset-2 col-lg-8">
                                <p class="paraAbout">I believe that if more people in the world learn how to speak English, the world would be better. </br></br>
                                Cultural boundaries will be smaller and people from all over the world can communicate each other. </br></br>
                                LingualBox has a mission to accomplish this by offering the most effective way of learning English by combining tutoring from top-notch tutors and technology. </br></br>
                                We are looking for tutors who are passionate with teaching. 
                                Without passion, teaching would be just like a boring tasks and nobody will be happy, but if you are passionate, you can deliver happiness to the students, company and to yourself. </br></br>
                                If you feel like LingualBox would fit to you, why don't you apply to be part of our tutors. We are waiting for you!</p>
                            </div>
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
    </div>

@endsection


@extends('layouts.master')
@section('title', 'Lingual Box')

@section('content')
    @include('blocks.navbar')
    <!-- Carousel
    ================================================== -->
    <div class="container-fluid homepageModel">
            <div class="row">
                <div class="container">
                <!-- Indicators -->
                    <div class="introHeading">
                        <h1 class="fontHeading">Teaching English Online</h1>
                        <p class="fontHome">Become a Professional English Teacher Online</p>
                        <p class="fontHome"><a class="btn btn-lg button-app" href="{{ route('register.first') }}" role="button">Apply Now!</a></p>
                    </div>
                </div>       
            </div>       
        </div><!-- /.carousel -->
    </div>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container-fluid marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 column1">
                <img class="img-responsive center-block house" src="{{ asset('img/home1.png') }}" alt="Work at home" width="140" height="140">
                <h2 class="fontHome">Flexible Time</h2>
                <p class="fontHome">Get better work-life balance with a flexitime job. Teach at your own convenient time. Control your own Schedule</p>
            </div><!-- /.col-lg-4 -->

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 column1">
                <img class="img-responsive center-block house" src="{{ asset('img/clock.png') }}" alt="Have a flexible time" width="130" height="130">
                <h2 class="fontHome">Work Home</h2>
                <p class="fontHome">Work within the comfort of your home without unnecessary expenses and experiencing heavy traffic</p>
            </div><!-- /.col-lg-4 -->

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 column1">
                <img class=" center-block house" src="{{ asset('img/friends.png') }}" alt="Have a flexible time" width="155" height="125">
                <h2 class="fontHome">International Community</h2>
                <p class="fontHome">Teach international students from every corner of the world. Share your culture. Make connection!</p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <div class="row requirement">
            
            <h2 class="text-center requirementHeading">Our requirements</h2>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="row requirementsRow">
                    <i class="glyphicon glyphicon-tags icons"></i>
                    <span class="heading1">A Bachelor Degree Holder</span>
                    <p>Preferably with a Bachelor degree from a reputable <br/> college or university.</p>
                </div>
                <div class="row requirementsRow">
                    <i class="glyphicon glyphicon-calendar icons"></i>
                    <span class="heading1">At least 6 months of experience </span>
                    <p>Must have at least 6 months of experience as a teacher. <br/> Call center experience is an advantage.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 teacherStanding">
                <img alt="Brand" src="{{ asset('img/teacherStanding.png') }}" width="280" height="390">
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="row requirementsRow">
                    <i class="glyphicon glyphicon-random icons"></i>
                    <span class="heading1">Minimum of 0.7 mbps</span>
                    <p>A good and stable internet connection for your class <br/>at least.</p>
                </div>
                <div class="row requirementsRow">
                    <i class="glyphicon glyphicon-briefcase"></i>
                    <span class="heading1">Professional and Friendly</span>
                    <p>Know your responsibilities and make your class fun! <br/> Share your interest, culture, and etc.</p>
                </div>
            </div>
            
        </div>

       
       <!-- Direction -->

        <div class="row direction">
            <h2 class="text-center directionHeading">How it works</h2>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <img class=" center-block house" src="{{ asset('img/fill-in.png') }}" alt="Have a flexible time" width="200" height="200">
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <img class=" center-block house" src="{{ asset('img/assess2.png') }}" alt="Have a flexible time" width="200" height="200">
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <img class=" center-block house" src="{{ asset('img/orient.png') }}" alt="Have a flexible time" width="200" height="200">
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <img class=" center-block house" src="{{ asset('img/start.png') }}" alt="Have a flexible time" width="200" height="200">
            </div>

            <h2 class="text-center lowerDirectionHeading">Just follow these simple steps and be a part of our Team!</h2>
            <!-- <p class="text-center"><a href="#">Read More</a></p> -->
        </div>

        <!-- Additional Apply now -->

        <div class="row applyNow">
            <h2 class="text-center applyNowHeading">Be a part of our Team!</h2>
            <h2 class="text-center applyNowSubHeading">Have a very rewarding job that you will enjoy. </h2>
            <p class="fontHome text-center"><a class="btn btn-lg button-app" href="{{ route('register.first') }}" role="button">Apply Now!</a></p>

        </div>


        <!-- /END THE FEATURETTES -->


        <!-- FOOTER -->
        <footer class="ourfooter">
            <div class="row">
                <div class="col-md-4 col-s-4 col-xs-4">
                    <h5 class="text-center headerFooter">Our site</h5>
                    <p class="text-center sites"><a href="{{ route('register.first') }}">Apply now!</a></p>
                    <p class="text-center"><a href="{{ route('about-us') }}">About us</a></p>
                </div>
    
                <div class="col-md-4 col-s-4 col-xs-4">
                    <h5 class="text-center headerFooter">Support</h5>
                    <p class="text-center"><a href="{{ route('help') }}">Help</a></p>
                    <p class="text-center">hr@lingualbox.com</p>
                </div>
    
                <div class="col-md-4 col-s-4 col-xs-4">
                    <h5 class="text-center headerFooter">Legal</h5>
                    <p class="text-center">Privacy Policy</p>
                </div>
            </div>

            <div class="footer-divider title-divider--black"></div>

            <div class="row">
                <div class="col-md-12">
                    <h5 class="text-center logoFooter">© LingualBox, Inc.</h5>
                </div>
            </div>
           <!-- <p class="pull-right"><a href="#">Back to top</a></p>
            <p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p> !-->
        </footer>

    </div><!-- /.container -->
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
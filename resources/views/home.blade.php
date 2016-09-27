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
                    <h1 class="fontHeading">Teaching English Online</h1>
                    <p class="fontHome">Become a Professional English Teacher Online</p>
                    <p class="fontHome"><a class="btn btn-lg button-app" href="{{ route('register.first') }}" role="button">Apply Now!</a></p>
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
            <div class="col-lg-4 column1">
                <img class="img-responsive center-block house" src="{{ asset('img/home1.png') }}" alt="Work at home" width="140" height="140">
                <h2 class="fontHome">Flexible Time</h2>
                <p class="fontHome">Get better work-life balance with a flexitime job. Teach at your own convenient time. Control your own Schedule</p>
            </div><!-- /.col-lg-4 -->

            <div class="col-lg-4 column1">
                <img class="img-responsive center-block house" src="{{ asset('img/clock.png') }}" alt="Have a flexible time" width="130" height="130">
                <h2 class="fontHome">Work Home</h2>
                <p class="fontHome">Work within the comfort of your home without unnecessary expenses and experiencing heavy traffic</p>
            </div><!-- /.col-lg-4 -->

            <div class="col-lg-4 column1">
                <img class=" center-block house" src="{{ asset('img/friends.png') }}" alt="Have a flexible time" width="140" height="125">
                <h2 class="fontHome">International Community</h2>
                <p class="fontHome">Teach international students from every corner of the world. Share your culture. Make connection!</p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <div class="row requirement">
            
            <h2 class="text-center requirementHeading">Our requirements</h2>

            <div class="col-lg-4">
                <div class="row">
                    <i class="glyphicon glyphicon-cutlery"></i>
                    <span>A Bachelor Degree Holder</span>
                </div>
                <div class="row">

                    
                </div>
            </div>

            <div class="col-lg-4">
                
            </div>

            <div class="col-lg-4">
                
            </div>
            
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 col-md-push-5">
            <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </div>
            <div class="col-md-5 col-md-pull-7">
            <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
            <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </div>
            <div class="col-md-5">
            <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
            </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->


        <!-- FOOTER -->
        <footer>
            <p class="pull-right"><a href="#">Back to top</a></p>
            <p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>

    </div><!-- /.container -->
@endsection
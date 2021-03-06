<nav class="navbar navbar-default registration">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('home') }}"><img alt="Brand" src="{{ asset('img/logo2.png') }}" style="height:22px;width:auto"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
          <li><a href="{{ route('auth.logout') }}">Logout</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<ul class="breadcrumb">
  <li class="{{  Route::currentRouteNamed('register.first') ? 'active' : 'completed' }}">
    <a href="{{ route('register.first') }}">
    <i class="fa fa-user"></i> Personal Info
    </a>
  </li>
   <li class="{{  Route::currentRouteNamed('register.second') ? 'active' : (  Auth::check() && Auth::user()->experiences()->exists() ? 'completed' : '' ) }}">
    <a href="{{ Auth::check() && Auth::user()->canFillExperience() ? route('register.second') : '#' }} ">
      <i class="fa fa-book"></i> Experience
    </a>
  </li>
   <li class="{{  Route::currentRouteNamed('register.third') ? 'active' : (  Auth::check() && Auth::user()->preference()->exists() ? 'completed' : '' ) }}">
     <a href="{{ Auth::check() && Auth::user()->canFillPreference() ? route('register.third') : '#' }} ">
      <i class="fa fa-photo"></i> Requirements
    </a>
  </li>
  <li class="{{ in_array(Route::currentRouteName(), ['pre.reading.exam', 'reading.exam']) ? 'active' : (  Auth::check() && Auth::user()->latestReadingExam()->exists() && Auth::user()->latestReadingExam->didPassed() ? 'completed' : '' ) }}">
     <a href="{{ Auth::check() && Auth::user()->canTakeReadingExam() ? route('pre.reading.exam') : '#' }} ">
      <i class="fa fa-book"></i> Reading Exam
    </a>
  </li>
  <li class="{{ in_array(Route::currentRouteName(), ['pre.written.exam', 'written.exam']) ? 'active' : (  Auth::check() && Auth::user()->latestWrittenExam()->exists() && Auth::user()->latestWrittenExam->didPassed() ? 'completed' : '' ) }}">
     <a href="{{ Auth::check() && Auth::user()->canTakeWrittenExam() ? route('pre.written.exam') : '#' }} ">
      <i class="fa fa-pencil"></i> Written Exam
    </a>
  </li>
</ul>
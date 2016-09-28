<nav class="navbar navbar-default profile" style="margin-bottom:50px">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
          <a class="navbar-brand"  href="{{ Auth::check() ? route('profile') : route('home') }}"><img alt="Brand" src="{{ asset('img/logo2.png') }}" style="height:22px;width:auto"></a>
        
          
        
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Hello, {{ Auth::user()->firstname }} <b class="caret"></b>
            </a>
          <ul class="dropdown-menu">
             <li><a href="{{ route('auth.logout') }}">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
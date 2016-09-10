<div id="navbar" className="navbar navbar-static-top navbar2" role="navigation">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><img alt="Brand" src="{{ asset('img/logo2.png') }}" style="height:22px;width:auto"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">

                <ul class="nav navbar-nav navbar-right">
                    <li><a >Apply now!</a></li>
                    <li class="{{  Route::currentRouteNamed('about-us') ? 'active' : ''}}">
                        <a href="{{ route('about-us') }}">About us</a>
                    </li>
                    <li class="{{  Route::currentRouteNamed('help') ? 'active' : ''}}">
                        <a href="{{ route('help') }}">Help</a>
                    </li>
                    @if(Auth::check())
                        <li class="dropdown">
                        <a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor:pointer">
                            Hello, {{ Auth::user()->firstname }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="{{ route('profile') }}">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                        </ul>
                        </li> 
                    @else
                        <li><a data-target="#login" data-toggle="modal" style="cursor:pointer">Log in</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
@extends('layouts.master')
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
      <a class="navbar-brand" href="{{route('home')}}">LingualBox</a>
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
  <li class="@yield('partOneComplete') @yield('partOneCurrent')">
    <a href="{{ route('register.first') }}">
      <i class="fa fa-user"></i> Personal Info
    </a>
  </li>
   <li class="@yield('partTwoComplete') @yield('partTwoCurrent')">
    <a href="{{ route('register.second') }}">
      <i class="fa fa-book"></i> Experience
    </a>
  </li>
   <li class="@yield('partThreeComplete') @yield('partThreeCurrent')">
    <a href="javascript:void(0);">
      <i class="fa fa-photo"></i> Requirements
    </a>
  </li>
</ul>
<div class="container-fluid">
  <div class="col-sm-8 col-sm-offset-2">
    <div class="well">
           @yield('form')
    </div>
  </div>
</div>
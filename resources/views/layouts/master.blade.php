<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/buttons.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
        @stack('css')
    </head>
    <body>
         @yield('content')
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/common.js') }}"></script>
        
        @stack('js')
    </body>
</html>

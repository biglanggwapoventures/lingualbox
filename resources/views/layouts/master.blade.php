<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    </head>
    <body>
         @yield('content')
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

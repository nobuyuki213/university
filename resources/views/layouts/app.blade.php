<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        {{-- bootstrap.min.css 4.1.3 --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.2/lux/bootstrap.min.css">
        <!--drawer Styles -->
        <link href="{{ asset('css/drawer.min.css') }}" rel="stylesheet">
    </head>
    <body class="drawer drawer--right drawer--navbarTopGutter" style="padding-top:4.5rem;">

        @include('commons.navbar')

        @yield('content')

        {{-- jquery-3.3.1.slim.min.js --}}
        {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
        {{-- popper.js/1.14.3/ --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        {{-- bootstrap.min.js 4.1.3 --}}
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <!-- jquery & iscroll.js Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{ asset('js/iscroll.js') }}"></script>
        <!-- drawer.min.js Scripts -->
        <script src="{{ asset('js/drawer.min.js') }}"></script>
        <!-- dropdown.js Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script>
        $(function() {
            $('.drawer').drawer();
        });
        </script>
    </body>
</html>

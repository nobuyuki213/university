<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!--drawer Css -->
        <link href="{{ asset('css/drawer.min.css') }}" rel="stylesheet">
        <!--hover Css -->
        <link href="{{ asset('css/hover-min.css') }}" rel="stylesheet">

        @yield('stylesheet')

        {{-- bootstrap.min.css 4.1.2 --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.2/lux/bootstrap.min.css">
        <!--My Css -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        @yield('stylesheet_fontawesome_after')

        @yield('headbreadcrumbs')
    </head>
    <body class="drawer drawer--right drawer--navbarTopGutter" style="padding-top:4.5rem;">

        @include('commons.navbar'){{-- in header --}}

        <main>

            @yield('breadcrumbs')

            @yield('content')

        </main>
        <footer>

        </footer>

        {{-- jquery-3.2.1.slim.min.js --}}
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        {{-- popper.js/1.14.3/ --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        {{-- bootstrap.min.js 4.1.3 --}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- jquery & iscroll.js Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{ asset('js/iscroll.js') }}"></script>
        <!-- drawer.min.js Scripts -->
        <script src="{{ asset('js/drawer.min.js') }}"></script>
        <script>
        $(document).ready(function() {
          $('.drawer').drawer();
        });
        </script>
        @yield('script')
    </body>
</html>

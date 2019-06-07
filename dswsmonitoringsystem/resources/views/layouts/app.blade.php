<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DSWS DISATER RELIEF MONITORING SYSTEM</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/bebas" type="text/css"/>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <style>
        html, body {
            background-image: url("{{asset('img/bg.jpg')}}");
            background-position: fixed;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .h1-style{
          font-family: 'BebasNeueRegular';
          background-color: #fff;
          padding: 5px;
          padding-bottom: 0;
          font-weight: normal;
          font-style: normal;
          font-size: 25px;
          color:#000;
        }
        .h2-style{
          font-family: 'BebasNeueRegular';
          background-color: #fff;
          padding: 5px;
          padding-bottom: 0;
          font-weight: normal;
          font-style: normal;
          font-size: 40px;
          letter-spacing: 2px;
          color:#000;
        }

    </style>
</head>
<body>
    <div id="app">
        @include('include.navbar2')
        <div class="login-header">
        <main class="">
            @yield('content')
        </main>
      </div>
    </div>
</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DSWS Disaster Relief MonitoringSystem</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/bebas" type="text/css"/>
        <link rel="stylesheet" href="/css/app.css">

        <!-- Styles -->
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
            .bg-txt{

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
          @include('include.navbar')
          <div class="text-center home-header">
            <img class="mb-3" src="{{URL::asset('/img/firecheck.png')}}" alt="dsws logo" height="150" width="150">
            <img class="mb-3" src="{{URL::asset('/img/dsws.png')}}" alt="dsws logo" height="130" width="130" style="margin-left: 30px">
            <div class="bg-txt">
              <h1 class="h1-style">Department of Social Welfare and Services</h1>
              <h2 class="h2-style">DISASTER RELIEF MANAGEMENT <br>AND MONITORING SYSTEM</h2>
            </div>
          </div>
    </body>
</html>

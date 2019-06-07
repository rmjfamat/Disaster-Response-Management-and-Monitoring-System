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
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <style>
        html, body {
            background-image: url("{{asset('img/mainbg7.jpg')}}");
            background-position: fixed;
            background-repeat: repeat-y;
            background-size: cover;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        .submit {
            background-color: transparent;
            border-color: transparent;
            color: rgb(255, 82, 6);
        }
        .submit:hover{
          color: #FFAF04 ;
        }

        .header-txt{
          color: #1d2731;
          font-weight: 600;
          letter-spacing: 2.5px;
        }

        .custom-tb-width{
          width: 90%;
          margin-top: 40px;
        }
        table{
          border: 1px solid white;
        }
        thead > tr{
          background-color: rgba(29, 39, 49, 0.8);
          text-align: center;
          font-size: 15px;
          color: #fff;

        }
        thead > tr:hover{
          background-color: rgba(29, 39, 49, 0.8);
          color: #fff;
        }
        th{
          width: 10%;
          font-weight: 100;
        }
        .width-15{
          width: 17%;
        }
        tr{
          text-align: center;
          background-color: rgba(254, 255, 255, 0.8);
          color: #000;
        }
        tr:hover{
          background-color: rgba(252, 220, 161, 0.6);
          color: #000;
        }

        .input-group{
          float: right;
          width: 30%;
          margin-bottom: 10px;
        }

        .form-control{
          background-color: rgba(255, 255, 255, 0.7);

        }
        .form-control::placeholder{
          color: #AFADA9;
          font-style: italic;
        }

    </style>
</head>
<body>
    <div id="app">
        @include('include.navbar2')
        <div class="container-fluid custom-tb-width">
        <h5 class="header-txt text-center">REPORTED FIRE INCIDENTS</h5><br>
        <form action="/search" method="GET">
          <div class="input-group">
            <input class="form-control" type="search" name="search" placeholder="Search"/>
            <span class="input-group-prepend">
              <button class="btn btn-primary" type="submit" style="height: 37px; background-color: #1d2731; border-color: #1d2731; color: #FE8606">Search</button>
            </span>
          </div>
        </form>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Code</th>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Region</th>
              <th scope="col">Province</th>
              <th scope="col">Municipality</th>
              <th scope="col">Baranggay</th>
              <th scope="col">Sitio</th>
            </tr>
          </thead>
          <tbody class= "tbody-light">
            @foreach($records as $class)
            <tr>
              <td>
                <form action="/victimsdata" method="GET">
                  <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                  <input class="submit" type="submit" value="{{$class->codeName}}"/>
                </form>
              </td>
              <td class="width-15">{{$class->Date}}</td>
              <td>{{$class->Time}}</td>
              <td>{{$class->Region}}</td>
              <td>{{$class->Province}}</td>
              <td>{{$class->Municipality}}</td>
              <td class="width-15">{{$class->Baranggay}}</td>
              <td class="width-15">{{$class->Sitio}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <h2 class="h6 h3-end">***end of table</h2>
      </div>
  </div>
</body>
</html>

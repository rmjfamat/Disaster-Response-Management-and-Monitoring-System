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
            background-image: url("{{asset('img/mainbg.jpg')}}");
            background-position: fixed;
            background-repeat: repeat-y;
            background-size: cover;
            color: #000;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100%;
            margin: 0;
        }
        #qrcode {
            width:160px;
            height:160px;
            margin-top:15px;
        }
        .table-width{
          margin-top: 80px;
          width: 97%;
        }

        .btn-top {
          margin-top: 280px;
        }
        .col{
          padding: 0;
        }

        .btn-space{
          background-color: rgba(29, 39, 49, 0.6);
          font-family: 'Nunito', sans-serif;
          font-weight: 100;
          color: #fff;
          border-radius: 0;
          border-color: rgba(29, 39, 49, 0.1);
          height: 50px;
          width: 225px;
          margin: 0;
        }

        .btn-space:hover{
          background-color: rgba(29, 39, 49, 0.7);
          border-color: rgba(29, 39, 49, 0.1);
          color: #FE8606;
        }

        .btn-active{
          background-color: rgba(29, 39, 49, 0.85);
          font-family: 'Nunito', sans-serif;
          color: #FE8606;
          font-weight: 100;
          border-radius: 0;
          margin: 0;
          border-color: rgba(29, 39, 49, 0.1);
          height: 50px;
          width: 225px;
        }
        .btn-active:hover{
          background-color: rgba(29, 39, 49, 1);
          border-color: rgba(29, 39, 49, 0.1);
          color: #FE8606;
        }

        .btn-print{
          background-color: rgba(245, 74, 46, 0.7);
          border-color: rgba(245, 74, 46, 0);
          padding: 0px;
          padding-left: 20px;
          padding-right: 20px;
          margin-top: 10px;
          margin-bottom: 10px;
          width: 120px;
          height: 32px;
          color: #000"
        }
        .btn-print:hover{
          background-color: rgba(245, 74, 46, 0.9);
          border-color: rgba(18, 29, 68, 0);
        }

        .btn-del{
          background-color: rgba(36, 174, 214, 0.8);
          border-color: rgba(86, 207, 242, 0);
          padding: 0px;
          padding-left: 20px;
          padding-right: 20px;
          margin-top: 10px;
          margin-bottom: 10px;
          width: 120px;
          height: 32px;
          color: #000"
        }

        .position-fixed{
          top: 10;
          position: fixed;
        }
        .logo-wrapper{
          margin-top: 30px;
          padding-left: 45px;
        }
        .img-fluid{
          height: 130px;
          width: 130px;
        }
        .col-10{
          padding: 40px;
          padding-bottom: 325px;
        }
        .info{
          margin: 10px;
          margin-top: 190px;
          padding-left: 32px;
        }
        .infotext{
          color: #1d2731;
          font-weight: 100;
          font-size: 14px;
          text-align: center;
        }

        thead > tr{
          background-color: rgba(29, 39, 49, 0.8);
          text-align: center;
          font-size: 15px;
          color: #fff;
        }
        th{
          font-size: 15px;
          font-weight: 100;
        }
        td{
          font-size: 14px;

        }
        tbody > tr:nth-child(odd) { background-color: rgba(254, 255, 255, 0.6);}

        .input-group{
          float: right;
          width: 30%;
          height: 95%;
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
      <div class="container-fluid ">
        <div class="row">
          @foreach($records as $class)
          <div class="col position">
            <div class="logo-wrapper waves-light position-fixed">
              <a href="#"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-HQ1PuamTlNv0NARX9iDujr6g4gE3HaGoP_vmCi8kGhUTklxk" class="img-fluid flex-center"></a>
            </div>
            <div class="position-fixed info">
            @foreach($records as $class)
              <h6 class="infotext">{{$class->Date}}</h6>
              <h6 class="infotext">{{$class->Sitio}}, {{$class->Baranggay}}</h6>
              <h6 class="infotext">{{$class->Municipality}}, {{$class->Province}}</h6>
              <input type="hidden" id="textPrefix" value="{{$class->codeName}}">
            @endforeach
          </div>
            <div class="btn-group-vertical position-fixed btn-top" role="group" aria-label="">
              <form action="/victimsdata" method="GET">
                <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                <button type="submit" class="btn btn-primary btn-space">Fire Victims' Information</button>
              </form>
              <form action="/editdata" method="GET">
                <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                <button type="submit" class="btn btn-secondary btn-active">Edit Victims Data</button>
              </form>
              <form action="/final-list" method="GET">
                <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                <button type="submit" class="btn btn-secondary btn-space">Fire Victims Summary List</button>
              </form>
              <form action="/assistance" method="GET">
                <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                <button type="submit" class="btn btn-secondary btn-space">Assistance Distribution Data</button>
              </form>
            </div>
          </div>
          @endforeach

          <div class="col-10" style="background-color: rgba(50, 140, 193, 0.3);">
            <br><br><br>
            <h5 align="center" style="color: #000; padding-bottom: 10px; margin-left: 5px;"> Partial list of fire victims. Data includes validated and unvalidated fire victims.</h5>
            <form action="/search-edit-data" method="GET">
              <div class="input-group">
                <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                <input class="form-control" type="search" name="search" placeholder="Search"/>
                <span class="input-group-prepend">
                  <button class="btn btn-primary" type="submit" style="height: 37px; background-color: #1d2731; border-color: #1d2731; color: #FE8606">Search</button>
                </span>
              </div>
            </form>
            <table class="table table-bordered">
              <thead class="text-center">
                <tr>
                  <th scope="col">Firstname</th>
                  <th scope="col">Middlename</th>
                  <th scope="col">Lastname</th>
                  <th scope="col">Validated</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              @foreach($info as $class)
              <tbody class= "text-center">
                <tr>
                  <td style="width: 15%; font-weight: 600">{{$class->firstname}}</td>
                  <td style="width: 15%; font-weight: 600">{{$class->middlename}}</td>
                  <td style="width: 15%; font-weight: 600">{{$class->lastname}}</td>
                  <td style="width: 15%">{{$class->verified}}</td>
                  @foreach($records as $classs)
                  <td style="width: 20%; padding: 0">
                    <form action="/editdata/update" method="GET">
                      <input type="hidden" name="codename" value ="{{$classs->codeName}}"/>
                      <input type="hidden" name="fname" value ="{{$class->firstname}}"/>
                      <input type="hidden" name="mname" value ="{{$class->middlename}}"/>
                      <input type="hidden" name="lname" value ="{{$class->lastname}}"/>
                      <button type="submit" class="btn btn-primary btn-print">Edit Data</button>
                    </form>
                  </td>
                  <td style="width: 20%; padding: 0">
                    <form action="/editdata/delete" method="GET">
                      <input type="hidden" name="codename" value ="{{$classs->codeName}}"/>
                      <input type="hidden" name="fname" value ="{{$class->firstname}}"/>
                      <input type="hidden" name="mname" value ="{{$class->middlename}}"/>
                      <input type="hidden" name="lname" value ="{{$class->lastname}}"/>
                      <button type="submit" onclick="return confirm('Are you sure you want to delete {{$class->firstname}} {{$class->middlename}} {{$class->lastname}} ')" class="btn btn-primary btn-del">Delete Data</button>
                    </form>
                  </td>
                  @endforeach
                </tr>
              </tbody>
              @endforeach
            </table>

              <h6 class="h6 h3-end">***end of table</h6>
          </div>
        </div>
      </div>
    </div>
    <script src="bundle.js"></script>
</body>
</html>

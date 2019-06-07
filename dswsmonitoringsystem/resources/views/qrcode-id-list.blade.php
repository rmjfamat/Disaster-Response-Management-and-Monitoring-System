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
        tbody > tr:nth-child(odd) { background-color: rgba(254, 255, 255, 0.8);}

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
                <button type="submit" class="btn btn-secondary btn-space">Edit Victims Data</button>
              </form>
              <form action="/final-list" method="GET">
                <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                <button type="submit" class="btn btn-secondary btn-active">Fire Victims Summary List</button>
              </form>
              <form action="/assistance" method="GET">
                <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                <button type="submit" class="btn btn-secondary btn-space">Assistance Distribution Data</button>
              </form>
            </div>
          </div>
          @endforeach

          <div class="col-10" style="background-color: rgba(50, 140, 193, 0.3);">
            @foreach($records as $class)
            <div class="btn-group float-left btn-top-right" role="group" aria-label="">
              <form action="/final-list" method="GET">
                <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                <button type="submit" class="btn btn-secondary btn-space" style="width: 150px; height: 40px">Back</button>
              </form>

            </div>
            @endforeach
            <br><br><br>
            <div class="btn-group float-right" role="group" aria-label="">
              <form action="/qrcode-id-list/qrcode-id-pdf" method="GET">
                <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                <input type="text" name="ids" placeholder="e.g. pages 1-2, 4-10, 1-20" style="padding: 6px;"required/>
                <button type="submit" class="btn btn-secondary btn-space btn-print" style="background-color: #F54A2E; border-color: #F54A2E; padding: 5px; padding-left: 20px; padding-right: 20px; margin-top: 10px; margin-bottom: 10px; width: 150px; height: 40px">Print IDs</button>
              </form>
            </div>
            <table class="table table-bordered">
              <thead class="text-center">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                  <th scope="col">Generated QRCode</th>
                </tr>
              </thead>
              @foreach($info as $class)
              <tbody class= "text-center">
                <tr>
                  <td style="width: 10%">{{$class->id}}</td>
                  <td style="width: 40%">{{$class->firstname}} {{$class->middlename}} {{$class->lastname}}
                    <p align="center" style="padding: 0; margin: 0;">{{$class->headGender}}</p>
                    <p align="center" style="padding: 0; margin: 0;">{{$class->head_age}} yrs old.</p>
                  </td>
                  <td style="width: 20%; padding: 0; margin: 0;"><img ng-src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($class->firstname . ' ' . $class->middlename . ' ' . $class->lastname, '../public/img/img-' . $class->id . '.png'))!!}" style="position: relative;	top: 0;	left: 0;"><img src="{{URL::asset('/img/img-' . $class->id . '.png')}}" style="position: relative;	top: 0;	left: 0;"> </td>

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

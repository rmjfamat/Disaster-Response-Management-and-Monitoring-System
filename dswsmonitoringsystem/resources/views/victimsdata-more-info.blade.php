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
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
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
          font-size: 13px;
          font-weight: 100;
        }
        td{
          font-size: 14px;
          color: #000;
        }
        tbody > tr:nth-child(odd) {background-color: rgba(254, 255, 255, 0.7); border: 0px;}
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
                  <button type="submit" class="btn btn-primary btn-active">Fire Victims' Information</button>
                </form>
                <form action="/editdata" method="GET">
                  <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                  <button type="submit" class="btn btn-secondary btn-space">Edit Victims Data</button>
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
              <div class="btn-group float-left" role="group" aria-label="">
                <form action="/victimsdata" method="GET">
                  <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                  <button type="submit" class="btn btn-secondary btn-space" style="width: 150px; height: 40px; margin-bottom: 10px;">Back</button>
                </form>
                <form action="/victims-more-info-socialwork" method="GET">
                  <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                  <button type="submit" class="btn btn-secondary btn-space" style="margin-left: 750px; width: 150px; height: 40px; margin-bottom: 10px;">More</button>
                </form>
              </div>
              <br><br><br>
              <h5 align="center" style="color: #000; padding-bottom: 10px; margin-left: 5px;"> All registered fire victims information.</h5>
              <form action="/search-victims-more-info" method="GET">
                <div class="input-group">
                  <input type="hidden" name="codename" value ="{{$class->codeName}}"/>
                  <input class="form-control" type="search" name="search" placeholder="Search"/>
                  <span class="input-group-prepend">
                    <button class="btn btn-primary" type="submit" style="height: 37px; background-color: #1d2731; border-color: #1d2731; color: #FE8606">Search</button>
                  </span>
                </div>
              </form>
                <table class="table ">
                  <thead class="text-center">
                    <tr>
                      <th scope="col">Firstname</th>
                      <th scope="col">Middlename</th>
                      <th scope="col">Lastname</th>
                      <th scope="col">Family Members</th>
                      <th scope="col">Resident Category</th>
                      <th scope="col">Special Specification</th>
                      <th scope="col">Health Condition</th>
                      <th scope="col">Estimated Damage</th>
                    </tr>
                  </thead>
                  @foreach($info as $class)
                  <tbody class= "text-center">
                    <tr>
                      <td style="width: 10%; font-weight: 600;">{{$class->firstname}}</td>
                      <td style="width: 10%; font-weight: 600;">{{$class->middlename}}</td>
                      <td style="width: 10%; font-weight: 600;">{{$class->lastname}}</td>
                      @if ($class->familyMember_1 == 'no family member' && $class->familyMember_2 == 'no family member' && $class->familyMember_3 == 'no family member')
                        <td style="width: 18%"><p>No family member.</p></td>
                      @elseif($class->familyMember_1 != 'no family member' && $class->familyMember_2 == 'no family member' && $class->familyMember_3 == 'no family member')
                        <td style="width: 18%"><div class="details" style="display:none"><p>{{$class->familyMember_1}}</p></div>
                            <a id="more" href="#" onclick="$('.details').slideToggle(function(){$('#more').html($('.details').is(':visible')?'See less':'Expand');});">Expand</a>
                        </td>
                        @elseif($class->familyMember_1 != 'no family member' && $class->familyMember_2 != 'no family member' && $class->familyMember_3 == 'no family member')
                          <td style="width: 18%"><div class="details" style="display:none"><p>{{$class->familyMember_1}}</p><p>{{$class->familyMember_2}}</p></div>
                              <a id="more" href="#" onclick="$('.details').slideToggle(function(){$('#more').html($('.details').is(':visible')?'See less':'Expand');});">Expand</a>
                          </td>
                          @elseif($class->familyMember_1 != 'no family member' && $class->familyMember_2 != 'no family member' && $class->familyMember_3 != 'no family member')
                            <td style="width: 18%"><div class="details" style="display:none"><p>{{$class->familyMember_1}}</p><p>{{$class->familyMember_2}}</p><p>{{$class->familyMember_3}}</p></div>
                                <a id="more" href="#" onclick="$('.details').slideToggle(function(){$('#more').html($('.details').is(':visible')?'See less':'Expand');});">Expand</a>
                            </td>
                      @endif
                      @if($class->residentCategory == 'Sharer')
                        <td style="width: 15%">{{$class->residentCategory}} of {{$class->sharerOf}}</td>
                      @elseif($class->residentCategory == 'Lodger or Boarder')
                        <td style="width: 15%">{{$class->residentCategory}} of {{$class->lodgerOf}}</td>
                      @elseif($class->residentCategory == 'Renter')
                        <td style="width: 15%">{{$class->residentCategory}} of {{$class->renterOf}}</td>
                      @else
                        <td style="width: 15%">{{$class->residentCategory}}</td>
                      @endif
                      <td style="width: 10%">{{$class->specialSpecs}}</td>
                      <td style="width: 10%">{{$class->healthCondition}}</td>
                      <td style="width: 10%">{{$class->estimatedDamages}}</td>
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

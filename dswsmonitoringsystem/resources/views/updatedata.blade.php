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
        .panel-body{
          background-color: rgba(214, 98, 36, 0.4);
          margin-right: 100px;
          margin-left: 100px;
          padding: 30px;
          padding-left: 100px;

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
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12 col-sm-6 col-xs-12">
                  <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                      <i class="icon-calendar"></i>
                      <h3 class="panel-title"></h3>
                    </div>

                    <div class="panel-body">
                      <form class="form-horizontal row-border" action="/editdata/update/success" method="GET">
                        <div class="form-group">
                          <div class="col-md-10">
                            @foreach($records as $class)
                            <input type="hidden" name="codename" class="form-control" value="{{$class->codeName}}">
                            @endforeach
                          </div>
                        </div>
                        @foreach($info as $class)

                        <div class="form-group">
                          <div class="col-md-10">
                            <input type="hidden" name="prevfname" class="form-control" value="{{$class->firstname}}">
                            <input type="hidden" name="prevmname" class="form-control" value="{{$class->middlename}}">
                            <input type="hidden" name="prevlname" class="form-control" value="{{$class->lastname}}">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label">Firstname</label>
                          <div class="col-md-10">
                            <input type="text" name="fname" class="form-control" value="{{$class->firstname}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Middlename</label>
                          <div class="col-md-10">
                            <input type="text" name="mname" class="form-control" value="{{$class->middlename}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Lastname</label>
                          <div class="col-md-10">
                            <input type="text" name="lname" class="form-control" value="{{$class->lastname}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Family Head's Age</label>
                          <div class="col-md-10">
                            <input type="text" name="age" class="form-control" value="{{$class->head_age}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Validated</label>
                          <div class="col-md-10">
                            <input type="text" name="verified" class="form-control" value="{{$class->verified}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Family Head's Gender</label>
                          <div class="col-md-10">
                            <input type="text" name="headGender" class="form-control" value="{{$class->headGender}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Family Head's Birthdate</label>
                          <div class="col-md-10">
                            <input type="text" name="bday" class="form-control" value="{{$class->headBirthdate}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Family Head's Address</label>
                          <div class="col-md-10">
                            <input type="text" name="address" class="form-control" value="{{$class->address}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Civil Status</label>
                          <div class="col-md-10">
                            <input type="text" name="civil_status" class="form-control" value="{{$class->civil_status}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Family Head's Occupation</label>
                          <div class="col-md-10">
                            <input type="text" name="occupation" class="form-control" value="{{$class->occupation}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Income</label>
                          <div class="col-md-10">
                            <input type="text" name="income" class="form-control" value="{{$class->income}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Ethnicity</label>
                          <div class="col-md-10">
                            <input type="text" name="ethnicity" class="form-control" value="{{$class->ethnicity}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Family Member 1</label>
                          <div class="col-md-10">
                            <input type="text" name="fami1" class="form-control" value="{{$class->familyMember_1}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Family Member 2</label>
                          <div class="col-md-10">
                            <input type="text" name="fami2" class="form-control" value="{{$class->familyMember_2}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Family Member 3</label>
                          <div class="col-md-10">
                            <input type="text" name="fami3" class="form-control" value="{{$class->familyMember_3}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">4PS Member</label>
                          <div class="col-md-10">
                            <input type="text" name="fps" class="form-control" value="{{$class->FPSMember}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Resident Category</label>
                          <div class="col-md-10">
                            <input type="text" name="residentCat" class="form-control" value="{{$class->residentCategory}}">
                          </div>
                        </div>

                        @if($class->residentCategory == 'Sharer')
                          <div class="form-group">
                            <label class="col-md-4 control-label">Resident Category</label>
                            <div class="col-md-10">
                              <input type="text" name="sharerOf" class="form-control" value="{{$class->sharerOf}}">
                            </div>
                          </div>
                        @elseif($class->residentCategory == 'Lodger or Boarder')
                          <div class="form-group">
                            <label class="col-md-4 control-label">Lodger/Boarder of</label>
                            <div class="col-md-10">
                              <input type="text" name="lodgerOf" class="form-control" value="{{$class->lodgerOf}}">
                            </div>
                          </div>
                        @elseif($class->residentCategory == 'Renter')
                          <div class="form-group">
                            <label class="col-md-4 control-label">Renter of</label>
                            <div class="col-md-10">
                              <input type="text" name="renterOf" class="form-control" value="{{$class->renterOf}}">
                            </div>
                          </div>
                        @endif

                        <div class="form-group">
                          <label class="col-md-4 control-label">Special Specification</label>
                          <div class="col-md-10">
                            <input type="text" name="special" class="form-control" value="{{$class->specialSpecs}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Health Condition</label>
                          <div class="col-md-10">
                            <input type="text" name="health" class="form-control" value="{{$class->healthCondition}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Estimated Damages</label>
                          <div class="col-md-10">
                            <input type="text" name="estimate" class="form-control" value="{{$class->estimatedDamages}}">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label">Source of Information</label>
                          <div class="col-md-10">
                            <input type="text" name="source" class="form-control" value="{{$class->infoSource}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Witnessed by:</label>
                          <div class="col-md-10">
                            <input type="text" name="witness" class="form-control" value="{{$class->witness}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Interviewed/Registered by:</label>
                          <div class="col-md-10">
                            <input type="text" name="interviewer" class="form-control" value="{{$class->interviewer}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Date Registered</label>
                          <div class="col-md-10">
                            <input type="text" name="dateReg" class="form-control" value="{{$class->dateRegistered}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Validated by:</label>
                          <div class="col-md-10">
                            <input type="text" name="validator" class="form-control" value="{{$class->validator}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Date Validated</label>
                          <div class="col-md-10">
                            <input type="text" name="dateVal" class="form-control" value="{{$class->dateValidated}}">
                          </div>
                        </div>
                        <br>
                        <div class="form-group">
                          <div class="col-md-6">
                            <button type="submit" onclick="return confirm('Are you sure you want to update {{$class->firstname}} {{$class->middlename}} {{$class->lastname}} information?')" class="btn btn-secondary btn-space" style="margin-left: 160px; margin-right: 160px;">Update Data</button>
                          </div>
                        </div>

                        @endforeach
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="bundle.js"></script>
</body>
</html>

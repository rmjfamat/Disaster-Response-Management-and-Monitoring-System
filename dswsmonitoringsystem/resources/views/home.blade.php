@extends('layouts.app')
@section('content')
<div class="text-center" style="margin-top: 80px;">
    <img class="mb-3" src="{{URL::asset('/img/firecheck.png')}}" alt="dsws logo" height="150" width="150">
    <img class="mb-3" src="{{URL::asset('/img/dsws.png')}}" alt="dsws logo" height="130" width="130" style="margin-left: 30px">
    <div class="bg-txt">
      <h1 class="h1-style">Department of Social Welfare and Services</h1>
      <h2 class="h2-style">DISASTER RELIEF MANAGEMENT <br>AND MONITORING SYSTEM</h2>
    </div>
  @if (session('status'))
      <div class="alert alert-success" role="alert" >
          {{ session('status') }}
      </div>
  @endif
  <p style="background-color: #fff; color: #1d2731; padding:0px; margin-left: 150px; margin-right: 150px;">You are logged in!</p>
  <a href="/firedata"><button type="button" class="btn btn-primary" style="background-color: #1d2731; border-color: #1d2731; font-size: 16px; color: #FE8606; padding: 10px; padding-left: 20px; padding-right: 20px; margin-top: 15px;">View Fire Incidents Data</button></a>
</div>

@endsection

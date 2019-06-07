@extends('layouts.app')
@section('content')
<div style="background-color: rgba(255, 255, 255, 0.7); margin-top: 120px; padding-top: 50px; padding-bottom: 50px;">
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <h5 class="text-center" style="color: #000; font-weight: 700;">ADMIN LOGIN</h5>
    <br>
    <div class="form-group row">
      <label for="username" class="col-md-4 col-form-label text-md-right" style="color: #000">{{ __('Username') }}</label>
        <div class="col-md-5">
          <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
            @if ($errors->has('username'))
              <span class="invalid-feedback" role="alert" >
                <strong>{{ $errors->first('username') }}</strong>
              </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
      <label for="password" class="col-md-4 col-form-label text-md-right" style="color:#000">{{ __('Password') }}</label>
        <div class="col-md-5">
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
          @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>
    </div>
    <div class="form-group row mb-0">
      <div class="col-md-5 offset-md-4" >
        <button type="submit" class="btn btn-primary btn-block" style="background-color: #1d2731; border-color: #1d2731; color: #FE8606; font-size: 16px;">
        {{ __('Login') }}
        </button>
      </div>
    </div>
  </form>
</div>

@endsection

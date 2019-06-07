<div class="flex-center custom-height bg-dark">
  @if (Route::has('login'))
      <div class="top-left links">
        <a href="/home"> <img src="{{URL::asset('/img/dsws.png')}}" alt="profile Pic" height="13" width="13"> Department of Social Welfare and Services</a>
      </div>
      <div class="top-right links">
          @auth
              <a href="{{ url('/home') }}">Home</a>
          @else
              <a href="{{ route('login') }}">Login</a>

              @if (Route::has('register'))
                  <a href="{{ route('register') }}">Register</a>
              @endif
          @endauth
      </div>
  @endif
  </div>

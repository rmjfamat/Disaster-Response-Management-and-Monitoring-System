<div class="flex-center custom-height bg-dark">
  <div class="top-left links">
    <a href="/home"> <img src="{{URL::asset('/img/dsws.png')}}" alt="profile Pic" height="13" width="13"> Department of Social Welfare and Services</a>
  </div>
  @guest
  <div class="top-right links" style="color: #FE8606;">
      <a href="{{ route('login') }}">{{ __('Login') }}</a>
      @if (Route::has('register'))
      <a href="{{ route('register') }}">{{ __('Register') }}</a>
      @endif
    </div>
  @else
  <div class="top-right links">
      <a href="/firedata">{{ __('DATA MONITORING') }}</a>
      <a href="{{ route('logout') }}"
         onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
      </a>
  </div>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>


  @endguest

</div>

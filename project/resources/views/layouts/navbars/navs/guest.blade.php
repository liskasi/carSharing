<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
  <div class="container-fluid">
    <div class="navbar-wrapper">
    <p class="navbar-brand" >{{ $namePage }}</p>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="now-ui-icons location_world"></i> {{ Config::get('languages')[App::getLocale()] }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        @if(Config::get('languages'))
          @foreach (Config::get('languages') as $lang => $language)
              @if ($lang != App::getLocale())
                      <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
              @endif
          @endforeach
        @endif
        </div>
        </li>

        <li class="nav-item">
          <a href="{{ route('homeguest') }}" class="nav-link">
            <i class="now-ui-icons design_app"></i> {{ __("Search for a car") }}
          </a>
        </li>
        <li class="nav-item @if ($activePage == 'register') active @endif">
          <a href="{{ route('register') }}" class="nav-link">
            <i class="now-ui-icons tech_mobile"></i> {{ __("Register") }}
          </a>
        </li>
        <li class="nav-item @if ($activePage == 'login') active @endif ">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="now-ui-icons users_circle-08"></i> {{ __("Login") }}
          </a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
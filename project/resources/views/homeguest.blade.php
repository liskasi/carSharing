<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!-- Extra details for Live View on GitHub Pages -->
  <title>
    Car Sharing
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ asset('assets') }}/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
</head>
<body class="{{ $class ?? '' }}">


<!-- Navbar -->
<nav  style="float:left;"class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <div class="navbar-toggle">
        <button type="button" class="navbar-toggler">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
    <a class="navbar-brand">Main</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <!-- <form>
        <div class="input-group no-border">
          <input type="text" value="" class="form-control" placeholder="Search...">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="now-ui-icons ui-1_zoom-bold"></i>
            </div>
          </div>
        </div>
      </form> -->
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="now-ui-icons users_single-02"></i>
            <p>
              <span class="d-lg-none d-md-block">{{ __("Account") }}</span>
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{ route('login') }}">{{ __("Login") }}</a>
            <a class="dropdown-item" href="{{ route('register') }}">{{ __("Register") }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <!-- End Navbar -->

   
    <!-- <canvas id="bigDashboardChart"></canvas> -->
    <form  method="POST"  action="{{action([App\Http\Controllers\CarController::class, 'guestfilter'])}}">
    <!-- <form  method="post"  action="{{ action([App\Http\Controllers\CarController::class, 'filter']) }}"> -->
    @csrf
    <div class="panel-header panel-header-default">
      <h3 class="text-center text-light" style="margin:0;padding-bottom: 10px;">Find a Car</h3>
      <div class="container container-table ">
          <span class="input-group no-border  center w-75" style="margin:0 auto;">
              <input type="text" name="seacrh" id="seacrh" value="" class="form-control input-lg" placeholder="Search..."  value="{{old('seacrh')}}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <i class="now-ui-icons ui-1_zoom-bold"></i>
                </div>
            </div>
          </span>
      </div>
  </div>
  <div style="height: 100%; width:100%;">
    <div class="p-2" style="display: inline-block; *display: inline; zoom: 1; height: 41%; vertical-align: top; width: 15%; background: #98BF64; border-top-right-radius: 15px; border-bottom-right-radius: 15px;">
    <div class="form-group">
        <label for="carMake" class="text-light">Car make</label>
        <input type="text" name="carMake" class="form-control  bg-light" id="carMake" aria-describedby="carMake" placeholder="Enter a car make..." value="{{old('carMake')}}">
    </div>
    <div class="form-group">
        <label for="carModel" class="text-light">Car model</label>
        <input type="text" name="carModel" class="form-control  bg-light" id="carModel" aria-describedby="carModel" placeholder="Enter a car model..." value="{{old('carModel')}}">
    </div>
    <div class="form-group">
        <label for="price" class="text-light">Price</label>
        <input type="text" name="price" class="form-control  bg-light" id="price" aria-describedby="price" placeholder="Enter a price..." value="{{old('price')}}">
    </div>
    <div class="form-group">
        <label for="carArea" class="text-light">Car area</label>
        <input type="text"  name="carArea" class="form-control  bg-light" id="carArea" aria-describedby="carArea" placeholder="Where is your car located?" value="{{old('carArea')}}">
    </div>
    <div >
      <button type="submit" class="btn btn-primary btn-round">{{__('Apply filters')}}</button>
    </div>

    </div>
  </form>

    <div class="bg-light"style="display: inline-block; *display: inline; zoom: 1; vertical-align: top; width: 50%; margin-left: 10%; border-radius: 25px;">
    @foreach ($carsDB as $c)
      <div class="p-2 m-3" style="height: 250px; border-radius: 15px; background:#D3D3D3;">
        <div style="display: inline-block; *display: inline; vertical-align: top; ">
        {{ $c->photo }}
        </div>
        <div style="display: inline-block; *display: inline;">
        <div>
          {{ $c->carMake }}, {{ $c->carModel}}
        </div>
        <div>
          {{ $c->price}} euro per minute
        </div>
        <div>
          Location: {{ $c->carArea}}
        </div>
         <div>
         </div>
        </div>
      </div>
      @endforeach

  </div>
  </div>


  <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
  <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
  <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
  <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets') }}/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets') }}/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('assets') }}/demo/demo.js"></script>
  @stack('js')
</body>

</html>



@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
@endpush
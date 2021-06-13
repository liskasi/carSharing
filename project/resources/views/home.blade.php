<?php 
use Illuminate\Support\Facades\Storage;
?>

@extends('layouts.app',[
    'namePage' => 'Dashboard',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
    <!-- <canvas id="bigDashboardChart"></canvas> -->
    <form  method="POST"  action="{{route('car.filter') }}">
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
  <div style=" width:100%; min-height: 100vh;">
    <div class="p-2" style="display: inline-block; *display: inline; height: 41%; vertical-align: top; width: 15%; background: #98BF64; border-top-right-radius: 15px; border-bottom-right-radius: 15px;">
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

    <div style="display: inline-block; *display: inline; zoom: 1; vertical-align: top; width: 50%; margin-left: 10%; border-radius: 25px;">
    <div class="dropdown pull-right">
    <button class="btn btn-secondary dropdown-toggle  " type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Sort by:
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <button class="dropdown-item" type="button">Price ascending</button>
      <button class="dropdown-item" type="button">Price descending</button>
      <button class="dropdown-item" type="button">Name A-Z</button>
      <button class="dropdown-item" type="button">Name Z-A</button>
    </div>
  </div>
    <div class="bg-light"  style=" border-radius: 25px; padding: 2%; margin-top: 60px;">
    @foreach ($carsDB as $c)
      <div class="p-2 m-2" style="height: 250px; border-radius: 15px; background:#D3D3D3;">
        <div style="display: inline-block; *display: inline; vertical-align: top; ">
        {{ $c->photo }}
        </div>
        <div style="display: inline-block; *display: inline;">
        <div>
        <a href="{{ url('car', $c->id) }}">{{ $c->carMake }}, {{ $c->carModel}}</a>
        </div>
        <div>
          {{ $c->price}} euro per minute
        </div>
        <div>
          Location: {{ $c->carArea}}
        </div>
         <?php if(auth()->user()->id == 1)
          { ?>
            <div>
              {{$c->status}}
            </div>
            <form method="POST" action="{{ action([App\Http\Controllers\CarController::class, 'status']) }}">
            @csrf
            <?php if($c->status == "Under consideration") { ?>
                <input type="hidden" name="id" value="{{ $c->id }}" />
                <button name="status" value="Approve">Approve</button>
                <button name="status" value="Reject">Reject</button>
                <?php } ?>

                <?php if($c->status == "Approved") { ?>
                <input type="hidden" name="id" value="{{ $c->id }}" />
                <button>Delete</button>
                <?php } ?>
            </form>
         <?php } ?>

        </div>
      </div>
      @endforeach

  </div>
    </div>
  </div>


@endsection





@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
@endpush
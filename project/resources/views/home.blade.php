@extends('layouts.app',[
    'namePage' => 'Dashboard',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
    <!-- <canvas id="bigDashboardChart"></canvas> -->
    <!-- <form method="POST"> -->
    <!-- <form  method="POST"  action="{{route('home') }}"> -->
    <form  method="post"  action="{{ action([App\Http\Controllers\CarController::class, 'filter']) }}">
    @csrf
    <div class="panel-header panel-header-default">
      <h3 class="text-center text-light" style="margin:0;padding-bottom: 10px;">{{__('messages.find')}}</h3>
      <div class="container container-table ">
          <span class="input-group no-border  center w-75" style="margin:0 auto;">
              <input type="text" name="search" id="search" class="form-control input-lg" placeholder="{{__('messages.search')}}"  value="{{old('seacrh')}}">
              <div class="input-group-append">
                <div class="input-group-text">
                <button type="submit"  style="background: none;	color: inherit;	border: none;	padding: 0;	font: inherit; cursor: pointer;	outline: inherit;"> <i class="now-ui-icons ui-1_zoom-bold"></i> </button>
                </div>
            </div>
          </span>
      </div>
  </div>
  <div style=" width:100%; min-height: 100vh;">
    <div class="p-2" style="display: inline-block; *display: inline; height: 41%; vertical-align: top; width: 15%; background: #98BF64; border-top-right-radius: 15px; border-bottom-right-radius: 15px;">
    <div class="form-group">
        <label for="carMake" class="text-light">{{__('messages.carMake')}}</label>
        <input type="text" name="carMake" class="form-control  bg-light" id="carMake" aria-describedby="carMake" placeholder="{{__('messages.carMakemessage')}}" value="{{old('carMake')}}">
    </div>
    <div class="form-group">
        <label for="carModel" class="text-light">{{__('messages.carModel')}}</label>
        <input type="text" name="carModel" class="form-control  bg-light" id="carModel" aria-describedby="carModel" placeholder="{{__('messages.carModelmessage')}}" value="{{old('carModel')}}">
    </div>
    <div class="form-group">
        <label for="price" style="width:100%;"class="text-light">{{__('messages.carPrice')}}</label>
        <input type="numeric" name="priceFrom" class="form-control  bg-light" id="priceFrom" aria-describedby="price" placeholder="{{__('messages.from')}}" style="width:40%; display: inline-block;"> <span class="text-light">- </span>
        <input type="numeric" name="priceTo" class="form-control  bg-light" id="priceTo" aria-describedby="price" placeholder="{{__('messages.to')}}" style="width:40%; display: inline-block;">
    </div>
    <div class="form-group">
        <label for="carArea" class="text-light">{{__('messages.carArea')}}</label>
        <input type="text"  name="carArea" class="form-control  bg-light" id="carArea" aria-describedby="carArea" placeholder="{{__('messages.carAreamessage')}}" value="{{old('carArea')}}">
    </div>
    <div >
      <button type="submit" id ="submitFilter" class="btn btn-primary btn-round">{{__('messages.apply')}}</button>
    </div>

    </div>

 
    </form>

    <div style="display: inline-block; *display: inline; zoom: 1; vertical-align: top; width: 50%; margin-left: 10%; border-radius: 25px;">
    <!-- <div class="dropdown pull-right">
    <button class="btn btn-secondary dropdown-toggle  " type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Sort by:
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <button class="dropdown-item" type="button">Price ascending</button>
      <button class="dropdown-item" type="button">Price descending</button>
      <button class="dropdown-item" type="button">Name A-Z</button>
      <button class="dropdown-item" type="button">Name Z-A</button>
    </div>
  </div> -->
    <div style=" border-radius: 5px; padding: 2%;">
    @foreach ($carsDB as $c)
      <div class="p-2 mb-2 border bg-light" style="height: 250px; border-radius: 5px;">
        <div style="display: inline-block; *display: inline;  height:100%; width:50%;">
          <div style="vertical-align: center; display:flex;justify-content: center;align-items: center;height:100%;">
            <img src="{{asset('/storage/images/'.$c->photo)}}" style="height: 200px;"/>
          </div>
        </div>
        <div style="display: inline-block; *display: inline; vertical-align: top; padding-top: 3%;">
        <div style="padding-bottom: 8%; font-size: 120%;">
        <a href="{{ url('car', $c->id) }}"><b>{{ $c->carMake }}, {{ $c->carModel}}</b></a>
        </div>
        <div>
          {{ $c->price}} euro per day
        </div>
        <div>
          Location: {{ $c->carArea}}
        </div>
        <?php

        if($c->ifRented =="yes") {  
        ?>
          <div>RENTED</div>
        <?php }?>
         <?php if(auth()->user()->id == 1)
          { ?>
            <div style="font-style: italic; padding: 9% 0%;">
              {{$c->status}}
            </div>
            <form method="POST" action="{{ action([App\Http\Controllers\CarController::class, 'status']) }}">
            @csrf
            <?php if($c->status == "Under consideration") { ?>
                <input type="hidden" name="id" value="{{ $c->id }}" />
                <button name="status" value="Approve" class="btn btn-primary btn-round" style=" background: #98BF64;">Approve</button>
                <button name="status" value="Reject" class="btn btn-primary btn-round">Reject</button>
                <?php } ?>

                <?php if($c->status == "Approved") { ?>
                <input type="hidden" name="id" value="{{ $c->id }}" />
                <button class="btn btn-primary btn-round">Delete</button>
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

    // $('#submitFilter').onclick(function()
    // {
    //   $.ajax({
    //       type: 'POST',
    //       url: 'App/Http/Controllers/CarController@filter',
    //       data:
    //       {
    //         carMake:$carMake,
    //         carModel:$carModel,
    //         price:$price,
    //         carArea:$carArea
    //       }
    //   })
    // })

  </script>
@endpush
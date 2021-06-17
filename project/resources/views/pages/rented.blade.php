@extends('layouts.app',[
    'namePage' => 'rented',
    'class' => 'sidebar-mini ',
    'activePage' => 'rented',
])

@section('content')

<div class="panel-header">
    <div class="header text-center">
        <h2 class="title">Rented cars</h2>
    </div>
</div>

<div style="min-height: 71vh;">
<div class="bg-light p-2"style=" width: 50%;  margin: auto; margin-top:1%; border-radius: 25px;">
<?php 
use App\Models\Car;
use App\Models\rentedCar;
$carsDB = rentedCar::where('user_id', auth()->user()->id)->get();
?>
@foreach ($carsDB as $c)
<form method="POST" action="{{ route('rentedcar.update') }}" autocomplete="off">
@csrf  
<?php $car = Car::where('id', $c->car_id)->first(); ?>
      <div class="p-2 m-2" style="height: 250px; border-radius: 15px; background:#D3D3D3;align-items: top;">
      <div style="display: inline-block; *display: inline;  height:100%; width:50%;">
          <div style="vertical-align: center; display:flex;justify-content: center;align-items: center;height:100%;">
            <img src="{{asset('/storage/images/'.$car->photo)}}" style="height: 200px;"/>
          </div>
        </div>
        <div style="display: inline-block; *display: inline;vertical-align: top; padding-top: 3%;">
        <div>
        <a href="{{ url('car', $car->id) }}">{{ $car->carMake }}, {{ $car->carModel}}</a>
        </div>
        <div>
          {{ $car->price}} euro per minute
        </div>
        <div>
          Location: {{ $car->carArea}}
        </div>
        <div>
          Status: {{ $car->status}}
        </div>
        </div>
        <input type="hidden" name="id" value="{{ $car->id }}" />
        <?php 
        // $rented = rentedCar::where('user_id', '=',auth()->user()->id)->where('car_id', '=',$c->id)->first();
        if($c->rentedStatus == "yes")
        { ?>
          <button name="action" value="return" class="btn btn-primary btn-round" style="vertical-align: top;align-items: left;margin-top: 15%;">Return</button>
          <?php }
        else
        {?>
<span>Returned</span>
        <?php } ?>

    </form>

      </div>
      @endforeach

  </div>
</div>


@endsection
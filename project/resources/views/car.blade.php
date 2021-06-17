@extends('layouts.app',[
    'namePage' => 'Car info',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
    <div class="panel-header panel-header-default">
      <div class="header text-center">
        <h2 class="title">Car info</h2>
        <h1 class="category ">{{$car->carMake}} {{$car->carModel}}</h1>
    </div>
    </div>

    <div class="pt-3 pb-3"  style=" width: 100%;min-height:72vh;">
      <div class="p-2" style="display: inline-block; *display: inline; min-width: 45%; min-height:38vh; vertical-align: top; padding-right:4%; background: #98BF64; border-top-right-radius: 15px; border-bottom-right-radius: 15px;">
      <img src="{{asset('/storage/images/'.$car->photo)}}" style="height: 500px;" />
      </div>
      <div style="display: inline-block; *display: inline; vertical-align: top; min-width: 30%; margin-left: 5%;border-radius: 25px;">
      <div class="p-2 " style=" background: linear-gradient(0deg, rgba(152,191,100,1) 0%, rgba(152,191,100,0.7147233893557423) 100%);">
      <ul  class="list-unstyled text-light pl-5">  
        <li><h4 class="text-light" style="color:#091bb9;text-shadow: 2px 2px rgba(6,15,89,0.4);"> <b> {{$car->carMake}} {{$car->carModel}} </b></h4></li>
        <li><b>Location:</b> {{$car->carArea}}</li>
        <li><b>Price:</b> {{$car->price}} euro/day</li>
        <li>{{$car->description}}</li>
        <li><i>For futher information:</i> {{$car->PhoneNumber}}</li>
        <li>{{$car->user_id}}</li>
        <?php

use Illuminate\Support\Facades\DB;

if(auth()->user()->id == 1){ ?>
        <li> <a href="{{asset('/storage/images/'.$car->documents)}}"> Click to open file</a></li>
        <?php } ?>
      </ul>
      </div>
      </br>

      <div >
      
      
      <form method="POST" action="{{route('rentedcar.store')}}">
      <!-- <form method="POST" action="{{ route('car.store') }}"> -->
      @csrf
      <input type="hidden" name="id" value="{{ $car->id }}" />
      <?php if($car->ifRented == "no"){?>
        <button  class="btn btn-primary btn-round">RENT</button>
        <?php } else {?>
          <button name="action" value="rent" disabled>RENT</button>
          <?php }?>
      </form>

    <?php if(auth()->user()->id == 1)
        { ?>
          <div style="font-style: italic; padding: 9% 0%;">
            {{$car->status}}
          </div>
          <form method="POST" action="{{ action([App\Http\Controllers\CarController::class, 'status']) }}">
          @csrf
          <?php if($car->status == "Under consideration") { ?>
              <input type="hidden" name="id" value="{{ $car->id }}" />
              <button name="status" value="Approve" class="btn btn-primary btn-round" style=" background: #98BF64;">Approve</button>
              <button name="status" value="Reject" class="btn btn-primary btn-round">Reject</button>
              <?php } ?>

              <?php if($car->status == "Approved") { ?>
              <input type="hidden" name="id" value="{{ $car->id }}" />
              <button class="btn btn-primary btn-round">Delete</button>
              <?php } ?>
          </form>
        <?php } ?>


      </div>
</br>
      <?php $commentsDB = DB::table('comments')->where('car_id', $car->id)->get()?>
      @foreach ($commentsDB as $c)
      <?php $ppl = DB::table('users')->where('id', $c->user_id)->first()?>
      <div class="p-2 mb-2 border bg-grey"> 
        <p><b>{{$ppl->name}}</b></p>
          <p>{{$c->comment}}</p>
          </div>
      @endforeach
<form method="POST" action="{{ route('comment.store') }}">
@csrf
<input type="hidden" name="id" value="{{ $car->id }}" />
    <?php $wasRented = DB::table('rented_cars')->where('user_id', auth()->user()->id)->where('car_id',$car->id)->first(); ?>
    <?php if($wasRented) {?>
      <textarea type="text" name="comment" id="comment"></textarea>
    <button class="btn btn-warning btn-round">Send</button>
    <?php } ?>
</form>
      </div>
    </div>

@endsection


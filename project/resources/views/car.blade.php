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
        <img src="{{$car->photo}}" ALIGN=”left”/>
      </div>
      <div class="p-2" style="display: inline-block; *display: inline; vertical-align: top; width: 40%; margin-left: 10%; background: #626262;border-radius: 25px;">
      <ul>  
        <li>{{$car->carMake}} {{$car->carModel}}</li>
        <li>Location: {{$car->carArea}}</li>
        <li>Price: {{$car->carArea}} euro/day</li>
        <li>{{$car->description}}</li>
        <li>For futher information: +{{$car->PhoneNumber}}</li>
        <li>{{$car->username}}</li>
      </ul>
      </div>
    </div>

@endsection


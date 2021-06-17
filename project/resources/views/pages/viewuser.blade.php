@extends('layouts.app', [
  'namePage' => 'Users',
  'class' => 'sidebar-mini',
  'activePage' => '',
])
@section('content')

@section('content')
    <div class="panel-header panel-header-default">
      <div class="header text-center">
        <h2 class="title">User info</h2>
        <h1 class="category ">{{$user->name}}</h1>
    </div>
    </div>

    <div class="pt-3 pb-3"  style=" width: 100%;min-height:72vh;">
      <!-- <div class="p-2" style="display: inline-block; *display: inline; min-width: 45%; min-height:38vh; vertical-align: top; padding-right:4%; background: #98BF64; border-top-right-radius: 15px; border-bottom-right-radius: 15px;">
      <img src="{{asset('/storage/images/'.$user->photo)}}" style="height: 500px;" />
      </div> -->
      <div class="p-2 " style="display: inline-block; *display: inline; vertical-align: top; min-width: 30%; margin-left: 5%;border-radius: 25px; background: linear-gradient(0deg, rgba(152,191,100,1) 0%, rgba(152,191,100,0.7147233893557423) 100%);">
      <ul class="list-unstyled p-2">
                    <li><b>{{$user->name}}</b></li>
                    <li>{{$user->email}}</li>
                    <li>User ID: {{$user->id}}</li>
                </ul>
      </div>

    <div class="grid-container" style="display: -ms-grid; display: grid; -ms-grid-columns: auto auto auto; grid-template-columns: auto auto auto;  grid-column-gap: 70px;  grid-row-gap: 45px;  grid-auto-rows: 100px;  padding: 10px;">
        <?php
use Illuminate\Support\Facades\DB;

        $caruser = DB::table('cars')->where('user_id','=',$user->id)->get(); ?>
        <?php foreach ($caruser as $c): ?>
            <div class="bg-light border rounded">
                <ul class="list-unstyled p-2">
                    <li><b><a href="{{ url('car', $c->id) }}">{{ $c->carMake }}, {{ $c->carModel}}</a></b></li>
                    <li>{{ $c->price}} euro per minute</li>
                    <li>Location: {{ $c->carArea}}</li>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
    </div>

@endsection
@extends('layouts.app', [
  'namePage' => 'My Cars',
  'class' => 'sidebar-mini',
  'activePage' => 'myCars',
])
@section('content')

<div class="panel-header">
    <div class="header text-center">
        <h2 class="title">My cars</h2>
        <p class="category">List of my cars</p>
    </div>
</div>
<div style="min-height: 71vh;">
<div class="bg-light p-2"style=" width: 50%;  margin: auto; margin-top:1%; border-radius: 25px;">
@foreach ($carsDB as $c)
<form method="POST" action="{{ action([App\Http\Controllers\CarController::class, 'change']) }}">
@csrf  
<input type="hidden" name="id" value="{{ $c->id }}" />
  <button name="action" value="Edit">Edit</button>
  <button name="action" value="Delete">Delete</button>
</form>
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
        <div>
          Status: {{ $c->status}}
        </div>
        </div>
      </div>
      @endforeach

  </div>
</div>

@endsection
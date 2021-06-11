@extends('layouts.app', [
  'namePage' => 'Add a Car',
  'class' => 'sidebar-mini',
  'activePage' => 'addCar',
])
@section('content')


<div class="panel-header">
    <div class="header text-center">
        <h2 class="title">Add a new car</h2>
        <p class="category">Enter information about a car below</p>
    </div>
</div>

<form class="p-3 px-5" method="post" action="{{ route('car.store') }}" autocomplete="off">
@csrf
@method('put')
    <div class="form-group">
        <label for="carMake">Car make</label>
        <input type="text" name="carMake" class="form-control w-50 bg-light" id="carMake" aria-describedby="carMake" placeholder="Enter a car make...">
    </div>
    <div class="form-group">
        <label for="carModel">Car model</label>
        <input type="text" name="carModel" class="form-control w-50 bg-light" id="carModel" aria-describedby="carModel" placeholder="Enter a car model...">
    </div>
    <div class="form-group">
        <label for="PhoneNumber">Contact information</label>
        <input type="text" name="PhoneNumber" class="form-control w-50 bg-light" id="PhoneNumber" aria-describedby="PhoneNumber" placeholder="+371 ...">
        <small id="PhoneNumber" class="form-text text-muted">Enter a phone number. It will be hidden for unauthorized users.</small>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" name="price" class="form-control w-50 bg-light" id="price" aria-describedby="price" placeholder="Enter a price...">
        <small id="PhoneNumber" class="form-text text-muted">(euro per hour)</small>
    </div>
    <div class="form-group">
        <label for="description">Desciption</label>
        <textarea type="text" name="description" class="form-control w-50 bg-light" id="description" aria-describedby="description" placeholder="Write some desciption..." style="border-radius: 1rem;"></textarea>
    </div>
    <div class="form-group">
        <label for="carArea">Car area</label>
        <input type="text"  name="carArea" class="form-control w-50 bg-light" id="carArea" aria-describedby="carArea" placeholder="Where is your car located?">
    </div>
    <div>
        <label class="form-label" for="photo">Add a photo</label>
        <input type="text" name="photo" class="form-control w-50 bg-light" id="photo" />
    </div>
    <button type="submit" class="btn btn-info btn-round">{{__('Add a car')}}</button>
</form>
@endsection
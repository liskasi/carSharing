@extends('layouts.app', [
  'namePage' => 'Add a Car',
  'class' => 'sidebar-mini',
  'activePage' => 'addCar',
])
@section('content')
@include('alerts.migrations_check')

<div class="panel-header">
    <div class="header text-center">
        <h2 class="title">Add a new car</h2>
        <p class="category">Enter information about a car below</p>
    </div>
</div>

<form class="p-3 px-5" method="post" action="{{ route('car.store') }}" autocomplete="off" enctype="multipart/form-data">
@csrf
@method('put')
    <div class="form-group">
        <label for="carMake">Car make</label>
        <input type="text" name="carMake" value="{{ old('carMake') }}" class="form-control w-50 bg-light" id="carMake" aria-describedby="carMake" placeholder="Enter a car make...">
        @if ($errors->has('carMake'))
            <span class="invalid-feedback" style="display: block;" role="alert">
            <strong>{{ $errors->first('carMake') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="carModel">Car model</label>
        <input type="text" name="carModel"  value="{{ old('carModel') }}" class="form-control w-50 bg-light" id="carModel" aria-describedby="carModel" placeholder="Enter a car model...">
        @if ($errors->has('carModel'))
            <span class="invalid-feedback" style="display: block;" role="alert">
            <strong>{{ $errors->first('carModel') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="PhoneNumber">Contact information</label>
        <input type="text" value="{{ old('PhoneNumber') }}" name="PhoneNumber" class="form-control w-50 bg-light" id="PhoneNumber" aria-describedby="PhoneNumber" placeholder="+371 ...">
        <small id="PhoneNumber" class="form-text text-muted">Enter a phone number. It will be visible only for authorized users.</small>
        @if ($errors->has('PhoneNumber'))
            <span class="invalid-feedback" style="display: block;" role="alert">
            <strong>{{ $errors->first('PhoneNumber') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" name="price" value="{{old('price') }}" class="form-control w-50 bg-light" id="price" aria-describedby="price" placeholder="Enter a price...">
        <small id="PhoneNumber" class="form-text text-muted">(euro per hour)</small>
        @if ($errors->has('price'))
            <span class="invalid-feedback" style="display: block;" role="alert">
            <strong>{{ $errors->first('price') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="description">Desciption</label>
        <textarea type="text" name="description" value="{{old('description')}}" class="form-control w-50 bg-light" id="description" aria-describedby="description" placeholder="Write some desciption..." style="border-radius: 1rem;"></textarea>
        @if ($errors->has('description'))
            <span class="invalid-feedback" style="display: block;" role="alert">
            <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="carArea">Car area</label>
        <input type="text"  name="carArea" value="{{old('carArea')}}" class="form-control w-50 bg-light" id="carArea" aria-describedby="carArea" placeholder="Where is your car located?">
        @if ($errors->has('carArea'))
            <span class="invalid-feedback" style="display: block;" role="alert">
            <strong>{{ $errors->first('carArea') }}</strong>
            </span>
        @endif
    </div>
    <div>
        <label class="form-label" for="photo">Add a photo</label>
        <input type="file" name="photo" value="{{old('photo')}}" class="form-control w-50 bg-light" id="photo" />
        @if ($errors->has('photo'))
            <span class="invalid-feedback" style="display: block;" role="alert">
            <strong>{{ $errors->first('photo') }}</strong>
            </span>
        @endif

    </div>
    <button type="submit" class="btn btn-info btn-round">{{__('Add a car')}}</button>
</form>
@endsection
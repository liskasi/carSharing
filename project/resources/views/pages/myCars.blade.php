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


@endsection
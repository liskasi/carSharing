@extends('layouts.app',[
    'namePage' => 'Lang check',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
<div class="panel-header panel-header-default">
    <div class="header text-center">
    </div>
</div>

        {{__('messages.welcome')}}
@endsection

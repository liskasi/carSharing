@extends('layouts.app', [
  'namePage' => 'Users',
  'class' => 'sidebar-mini',
  'activePage' => '',
])
@section('content')

<div class="panel-header">
    <div class="header text-center">
        <h2 class="title">Users</h2>
        <p class="category">List of all users</p>
    </div>
</div>
<div style="min-height: 71vh;">
    <div class="grid-container" style="display: -ms-grid; display: grid; -ms-grid-columns: auto auto auto; grid-template-columns: auto auto auto;  grid-column-gap: 70px;  grid-row-gap: 45px;  grid-auto-rows: 100px;  padding: 10px;">
        <?php foreach ($users as $u): ?>
            <div class="bg-light border rounded">
            <a href="{{ url('viewuser', $u->id) }}" class="text-dark" style="text-decoration:none;">
                <ul class="list-unstyled p-2">
                    <li><b>{{$u->name}}</b></li>
                    <li>{{$u->email}}</li>
                    <li>User ID: {{$u->id}}</li>
                </ul>
            </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

@endsection
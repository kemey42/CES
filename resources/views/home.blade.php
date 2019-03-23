@extends('layouts.app') 
@section('content')

<h2>Welcome {{ Auth::user()->name }}!</h2>

<hr/>

<div class="row justify-content-center">
  <div class="col-md-12">

    <div class="card">
      <div class="card-body">

        {{-- Content tab --}}

        <p>Choose dashboard below:</p>

        <ul class="nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link" href="/coach">Personal Coaching Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/class">Class Dashboard</a>
          </li>
        </ul>

        {{-- End content tab --}} </div>
    </div>
  </div>
</div>
@endsection
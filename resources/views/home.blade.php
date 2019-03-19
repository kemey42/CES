@extends('layouts.app') 
@section('content')

<div class="jumbotron py-4">
  <h3>Welcome to Dashboard</h3>
  <hr/>
  <span>Full name: {{ Auth::user()->name }}</span><br/>
  <span>Email address: {{ Auth::user()->email }}</span><br/>
  <span>Member since: {{ Auth::user()->created_at->format('d M Y') }}</span>
</div>

<div class="row justify-content-center">
  <div class="col-md-3">

    <h5>Menu</h5>
    @role('writer') I am a writer! @else
    <nav class="nav flex-column">
      <a class="nav-link active" href="#">Active</a>
      <a class="nav-link" href="/Announcement/1/edit">Announcement</a>
      <a class="nav-link" href="#">Link</a>
      <a class="nav-link disabled" href="#">Disabled</a>
    </nav>

    @endrole

  </div>


  <div class="col-md-9">
    <div class="card">
      <div class="card-body">

        <h3>Welcome to Dashboard</h3>
        <br/>




      </div>
    </div>
  </div>
</div>
@endsection
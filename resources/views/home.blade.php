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
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">

        <h3>Welcome to Dashboard</h3>
        <br/>




      </div>
    </div>
  </div>
</div>
@endsection
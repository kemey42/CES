@extends('layouts.app') 
@section('content')

<h2>User: {{$user->fullname}}</h2>
<hr/>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card">
                <div class="card-header">
                    Information
                    @if(auth()->user()->id == $user->id || auth()->user()->can('edit user'))
                        <a href="/user/{{$user->id}}/edit" class="link float-md-right">Edit</a>
                    @endif
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Full name: {{$user->fullname}}</li>
                    <li class="list-group-item">User no. : {{$user->id}}</li>
                    <li class="list-group-item">Email address: {{$user->email}}</li>
                    <li class="list-group-item">Phone number: {{$user->phone_number}}</li>
                    <li class="list-group-item">Mailing address: {{$user->address}}</li>
                    <li class="list-group-item">Member since: {{$user->created_at->format('d M Y')}}</li>
                    <li class="list-group-item">User role: {{$user->getRoleNames()->implode(', ')}}</li>
                </ul>
            </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header">
                Hellllo
            </div>
            <div class="card-body">
                Yeahhhh i know
            </div>
        </div>
    </div>
</div>

@endsection
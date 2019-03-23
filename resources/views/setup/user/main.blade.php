@extends('layouts.app') 
@section('content')

<h2>User Setup</h2>
<a href="/register" class="btn btn-primary">Create New User</a>

<hr/>


<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                List of all users
            </div>
            <div class="card-body">

                {{-- Content --}}

                <table class="table table-striped table-responsive-lg css-serial">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Member since</th>
                            <th scope="col">Role</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td scope="row"></td>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td></td>
                            <td>{{$user->created_at->format('d M Y')}}</td>
                            <td>{{$user->getRoleNames()->implode(', ')}}</td>
                            <td><a href="#" class="stretched-link">View</a></td>
                            <td><a href="#" class="stretched-link">Edit</a></td>
                            <td><a href="#" class="stretched-link">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $users->links() }}
                {{-- Content end --}}

            </div>
        </div>
    </div>
</div>
@endsection
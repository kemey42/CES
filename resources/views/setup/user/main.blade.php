@extends('layouts.app') 
@section('content')

<h2>User Setup</h2>
<a href="/register" class="btn btn-primary">Create New User</a>

<hr/> 

{{-- Search form --}}
<p>
    <a class="link" data-toggle="collapse" href="#searchForm" role="button" aria-expanded="false" aria-controls="searchForm">
    Search Filter >>
</a>
</p>
<div class="collapse" id="searchForm">
    <div class="card card-body">
        {!! Form::open(['action' => ['UserController@filter'], 'method' => 'POST']) !!}
        <div class="form-group mb-0">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    {{Form::text("name", old("name") ? old("name") : (!empty($_GET['filter']['name']) ? $_GET['filter']['name'] : null), [ "class"
                    => "form-control", "placeholder" => "Name"] )}}
                </div>
                <div class="col-md-3">
                    {{Form::text("email", old("email") ? old("email") : (!empty($_GET['filter']['email']) ? $_GET['filter']['email'] : null),
                    [ "class" => "form-control", "placeholder" => "Email Address" ] )}}
                </div>
                <div class="col-md-3">
                    {{Form::select("user-role", $rolelist, old("user-role") ? old("user-role") : (!empty($_GET['filter']['has_roles']) ? $_GET['filter']['has_roles']
                    : null), [ "class" => "form-control", "placeholder" => "Choose role below: -" ] )}}
                </div>
                <div class="col-md-1">
                    {{Form::submit('Search', ['class' => 'btn btn-primary'])}}
                </div>
                <div class="col-md-1">
                    <a href='/user' class="btn btn-light">Clear</a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <br/>
</div>

{{-- End search form --}}

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
                            <td><a href="/user/{{$user->id}}/view" class="link">View</a></td>
                            <td><a href="/user/{{$user->id}}/edit" class="link">Edit</a></td>
                            <td><a href="/user/{{$user->id}}/delete" class="link">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $users->links() }} {{-- Content end --}}

            </div>
        </div>
    </div>
</div>
@endsection
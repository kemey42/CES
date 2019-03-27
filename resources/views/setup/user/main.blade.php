@extends('layouts.app') 
@section('content')

<h2>User Setup</h2>

<hr/> 

{{-- Search form --}}
<p>
    <a class="link" data-toggle="collapse" href="#searchForm" role="button" aria-expanded="false" aria-controls="searchForm">
    Search Filter >>
    </a>
</p>

<div class="collapse {{ (!empty($_GET['filter'])) ? 'show' : ''  }}" id="searchForm">
    <div class="card card-body">
        {!! Form::open(['action' => ['UserController@filter'], 'method' => 'POST']) !!}
        <div class="form-group mb-0">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    {{Form::text("fullname", old("fullname") ? old("fullname") : (!empty($_GET['filter']['fullname']) ? $_GET['filter']['fullname']
                    : null), [ "class" => "form-control", "placeholder" => "Name"] )}}
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

@if (!empty($_GET['filter']))
<div class="alert alert-primary" role="alert">
    Showing results for <u>{{(!empty($_GET['filter']['fullname']) ? $_GET['filter']['fullname'] : null)}}</u>
    <u>{{(!empty($_GET['filter']['email']) ? $_GET['filter']['email'] : null)}}</u>
    <u>{{(!empty($_GET['filter']['has_roles']) ? $_GET['filter']['has_roles'] : null)}}</u> (Total results: {{ $users->total()
    }})
</div>
@endif {{-- End search form --}}

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                List of all users <a href="/register" class="float-md-right">Create New User</a>
            </div>
            <div class="card-body">

                {{-- Content --}}

                <table class="table table-striped table-responsive-lg css-serial">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 3%">#</th>
                            <th scope="col" style="width: 8%">User No.</th>
                            <th scope="col" style="width: 27%">Name</th>
                            <th scope="col" style="width: 18%">Email</th>
                            <th scope="col" style="width: 12%">Phone Number</th>
                            <th scope="col" style="width: 12%">Member since</th>
                            <th scope="col" style="width: 5%">Role</th>
                            <th scope="col" style="width: 5%"></th>
                            <th scope="col" style="width: 5%"></th>
                            <th scope="col" style="width: 5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td scope="row"></td>
                            <td>{{$user->id}}</td>
                            <td>{{$user->fullname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone_number}}</td>
                            <td>{{$user->created_at->format('d M Y')}}</td>
                            <td>{{(!empty($_GET['filter']['has_roles']) ? $_GET['filter']['has_roles'] : $user->getRoleNames()->implode(',
                                '))}}</td>
                            <td><a 
                                @can('view user') 
                                    href="/user/{{$user->id}}" class="link" 
                                @else
                                    class="text-muted"
                                @endcan>View</a></td>
                            <td><a 
                                @can('edit user')
                                    href="/user/{{$user->id}}/edit" class="link"
                                @else
                                    class="text-muted"
                                @endcan>Edit</a></td>
                            <td><a @can('edit user')
                                    href="/user/{{$user->id}}/delete" class="link"
                                @else
                                    class="text-muted"
                                @endcan>Delete</a></td>
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
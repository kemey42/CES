<nav class="navbar navbar-expand-md navbar-dark navbar-laravel bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'CES (OFFLINE)') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest

                <span></span> @else
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                @role('admin')

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" v-pre>
                            Admin Setup <span class="caret"></span>
                        </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="/user">User</a>
                        <a class="dropdown-item" href="#">Roles</a>
                        <a class="dropdown-item" href="#">Permission</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/Announcement/1/edit">Announcement</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Package</a>
                        <a class="dropdown-item" href="#">Course</a>
                        <a class="dropdown-item" href="#">Assignment</a>
                        <a class="dropdown-item" href="#">Coaching Slot</a>

                    </div>
                </li>
                @endrole


                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" v-pre>
                        User
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="min-width: 300px;">

                        {{-- <a class="dropdown-item-text"><small>Full name: {{ Auth::user()->name }}</small></a> --}}
                        <a class="dropdown-item-text"><small>Full Name: {{ Auth::user()->fullname }}</small></a>
                        <a class="dropdown-item-text"><small>Role: {{ Auth::user()->getRoleNames()->implode(', ') }}</small></a>
                        <a class="dropdown-item-text"><small>Email address: {{ Auth::user()->email }}</small></a>
                        <a class="dropdown-item-text"><small>Member since: {{ Auth::user()->created_at->format('d M Y') }}</small></a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/password/change">Change Password</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
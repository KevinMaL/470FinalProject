<!DOCTYPE html>
<html lang="en">
    <head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Workout The Hard Way</title>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script>
	window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <link href="{{ mix('/css/app.css') }}" media="all" rel="stylesheet" type="text/css" />


    @yield('headers')

    </head>

    <body>
        <div class="container">
            @if(Request::is('/'))
                <div class="col-md-12 home-slide" style="padding:0;">
                    <div class="main-header">
                        <h1 style="
                            position: absolute;
                            bottom: 0;
                            padding: 20px;
                            margin:0;
                            text-transform: uppercase;
                            text-shadow: 2px 2px #000;
                            color: #fff;
                        ">Workout The Hard Way</h1>
                    </div>
                    <div class="slider-1" style="height:400px; width:100%;">
                        <div style="height:400px; width:100%; background-image:url('/assets/images/workout2.png')" ></div>
                    </div>
                </div>
            @endif
            <nav class="navbar navbar-toggleable-md navbar-light" style="border:1px solid #ddd;">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="plan">Workout Plans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/blogs">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/allgroups">Groups</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/BMI">BMI Calculator</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/calories">Calories Record</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mr-auto pull-right">
                        @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin/user') }}">All User</a>
                        </li>
                        @if (Auth::check() && Auth::user()->is_admin)
                        @endif
                        <li class="nav-item">
                            @if(app(App\Http\Controllers\Message\MessageController::class)->hasNew())
                            <a class="nav-link" href="{{ url('/user/message/unread') }}" style="float:left; color:red;"><i>new</i></a>
                            @endif
                            <a class="nav-link" href="{{ url('/user/message') }}" style="float:left;">Message</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/user/me') }}">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/register') }}">Register</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>

        @yield('content')
    </body>
</html>

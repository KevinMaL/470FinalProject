<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Final Project Admin</title>

        <!-- CSS And JavaScript -->
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ mix('/css/app.css') }}" media="all" rel="stylesheet" type="text/css" />


    </head>

    <body>
        <div class="container">

            <nav class="navbar navbar-default">
                <div class="admin-title">Admin Backend</div>
                <!-- Navbar Contents -->
            </nav>
        </div>

        @yield('content')
    </body>
</html>

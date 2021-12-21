<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>

    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    @yield('header_link')
</head>

<body class="row">
    <div class="header">
        <img src="image/logo.png" class="logo" id="icon" alt="User Icon" style="width: 50px; height:50px;" /></a>
        <div class="header-right">
            <a  href="{{url('records')}}">Dashboard</a>
            <a href="{{url('new-post')}}">New Post</a>
            <a href="{{url('post')}}">View Post</a>
            <a href="{{url('deleted-post')}}">Deleted Post</a>
            
            @inject('DataTrait','App\Http\Controllers\RecordsController')
            @php ($id = auth()->guard('web')->user()->id)

            @php ($profile = $DataTrait->getProfile('user',$id))
            <div class="dropdown">
                <button class="dropbtn">{{ $profile->email }}</button>
                <div class="dropdown-content">
                    <a href="#">User Name : {{ $profile->name }}</a>
                    <a href="{{ route('logout')}}"> Logout</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
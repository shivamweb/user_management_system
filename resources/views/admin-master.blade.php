<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    @yield('header_link')
</head>

<body class="row">
    <div class=" col-md-2">
        <div class="d-flex flex-column flex-shrink-0 bg-light vh-100">
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item"> <a href="{{url('admin-dashboard')}}" class="nav-link  py-3 border-bottom"> <i class="fa fa-dashboard"></i> <small>Dashboard</small> </a> </li>
                <li> <a href="{{url('report')}}" class="nav-link py-3 border-bottom"> <i class="fa fa-first-order"></i> <small>Report</small> </a> </li>
                <li> <a href="{{ url('belongsToMany')}}" class="nav-link py-3 border-bottom"> <i class="fa fa-cog"></i> <small>Mant to Many</small> </a> </li>
                <li> <a href="{{ url('user-login-report')}}" class="nav-link py-3 border-bottom"> <i class="fa fa-bookmark"></i> <small>User Login History</small> </a> </li> 
            </ul>

        </div>
    </div>
    <div class=" col-md-10">
        <div class="row" style="background-color: BLACK; padding-top: 20px;color:white; height:60px">
            <div class="col-md-10"> 
                    <center><strong>@yield('content_title')</strong></center> 
            </div>
            <div class="col-md-2" style="margin-top: -16px;">
                @inject('DataTrait','App\Http\Controllers\RecordsController')
                @php ($id = auth()->guard('admin')->user()->id)

                @php ($profile = $DataTrait->getProfile('admin',$id))
                <div class="dropdown">
                    <button class="dropbtn">{{ $profile->email }}</button>
                    <div class="dropdown-content">
                        <a href="#">User Name : {{ $profile->name }}</a>
                        <a href="{{ route('admin-logout')}}" class="nav-link py-3 border-bottom"> <img src="image/logo.png" alt="mdo" width="24" height="24" class="rounded-circle"> <small>Logout</small> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @yield('content')

        </div>
    </div>
</body>

</html>
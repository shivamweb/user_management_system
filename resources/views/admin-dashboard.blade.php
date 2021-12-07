<!DOCTYPE html>
<html>

<head>

    <link href="{{ asset('/css/admin-dashboard.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div class="row col-md-1">
        <div class="d-flex flex-column flex-shrink-0 bg-light vh-100" style="width: 100px;">
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item"> <a href="{{url('admin-dashboard')}}" class="nav-link active py-3 border-bottom"> <i class="fa fa-dashboard"></i> <small>Dashboard</small> </a> </li>
                <li> <a href="{{url('report')}}" class="nav-link py-3 border-bottom"> <i class="fa fa-first-order"></i> <small>Report</small> </a> </li>
                <li> <a href="#" class="nav-link py-3 border-bottom"> <i class="fa fa-cog"></i> <small>Settings</small> </a> </li>
                <li> <a href="{{ url('user-login-report')}}" class="nav-link py-3 border-bottom"> <i class="fa fa-bookmark"></i> <small>User Login History</small> </a> </li>
                <li> <a href="{{ route('admin-logout')}}" class="nav-link py-3 border-bottom"> <img src="image/logo.png" alt="mdo" width="24" height="24" class="rounded-circle"> <small>Logout</small> </a> </li>
            </ul> 
        </div>
    </div>
    <div class="row col-md-11">
        <!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->
        <div style=" background-color: BLACK; padding: 22px;color: #fff;">
            <center>
                <strong>ADMIN DASHBOARD</strong>
            </center>
        </div>
        <div style=" background-color: #fff; padding: 30px;">

        </div>
        <div class="container" style="background-color: #bdb4b46b;">

            <div class="row profile">
                @foreach ($records as $record)
                <div class="col-md-3">
                    <div class="profile-sidebar">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="store_image/fetch_image/{{ $record->id }}" class="img-responsive" alt="">
                        </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">
                                {{$record->name}}
                            </div>
                            <div class="profile-usertitle-job">
                                {{$record->email}}
                            </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <div class="profile-userbuttons">
                            <a href="{{ route('delete',['id'=>$record->id])}}" onclick="return confirm('Are you sure, you want to delete?')">
                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                            </a>
                        </div>
                        <!-- END SIDEBAR BUTTONS -->
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <ul class="nav">
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-user"></i> Age : {{$record->age}}</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-user"></i>Contact : {{$record->contact}}</a>
                                </li>
                                <li>
                                    <a href="#"><i class="glyphicon glyphicon-user"></i>Account : {{$record->is_email_verified == 1? ' Verified' : 'Un-Verified' }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- END MENU -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
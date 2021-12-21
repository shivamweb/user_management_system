@extends('admin-master')

@section('title', 'Admin Dashboard')

@section('header_link')
<link href="{{ asset('/css/admin-dashboard.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@endsection

@section('content_title', 'Admin Dashboard')

@section('content')
<div class="container" style="background-color: #bdb4b46b;">

    <div class="row profile">
        @foreach ($records as $record)
        <div class="col-md-4">
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
    <div class="row" style="padding: 20px;float: right;"> {{ $records->links() }}</div>
</div>
@endsection
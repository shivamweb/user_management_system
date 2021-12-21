@extends('admin-master')

@section('title', 'User Login Report')

@section('header_link')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('/js/user-login-report.js') }}"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@endsection

@section('content_title', 'Admin Dashboard')

@section('content')

<div class="container" style="padding: 20px;">
    <div class="row header" style="text-align:center;color:green">
        <h3>User Login an Logout History</h3>
    </div>
    <div class="row " style=" text-align:center; margin-left: 30%;">
        <div class="col-md-6 ">
            <select class="form-select center" name="user_list" id="user_list" onchange="user_history()">
                <option value="">Select User</option>
                @foreach ($users as $user)
                <option value="{{ $user->id}}">{{ $user->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="user_history_list" style="padding: 20px;"></div>
</div>
@endsection
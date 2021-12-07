<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="{{ asset('/css/admin-login.css') }}" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- Include the above in your HEAD tag -->

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<div class="main">
    <div class="container">
        <center>
        <div class="row">
            @if(session()->get('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div><br />
            @endif
            @if(session()->get('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div><br />
            @endif
        </div>
            <div class="middle">
                <div id="login" style="padding-top: 50px;">
                    <form action="{{url('admin-login')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="clearfix">
                            <p><span class="fa fa-user"></span>
                                <input type="text" name="email" Placeholder="Username" required>
                                <lable id="email_error" class="text-danger"> @if ($errors->has('email')) {{ $errors->first('email') }} @endif</lable>
                            </p>
                            <p><span class="fa fa-lock"></span>
                                <input type="text" name="password" Placeholder="Password" required>
                                <lable id="password_error" class="text-danger"> @if ($errors->has('password')) {{ $errors->first('password') }} @endif</lable>
                            </p>
                            <div>
                                <span style="width:48%; text-align:left;  display: inline-block;">
                                    <a class="small-text" href="#">Forgot password?</a>
                                </span>
                                <span style="width:50%; text-align:right;  display: inline-block;">
                                    <input type="submit" value="Sign In">
                                </span>
                            </div>
                        </fieldset>
                        <div class="clearfix"></div>
                    </form>
                    <div class="clearfix"></div>
                </div> <!-- end login -->
                <div class="logo">
                    <img src="image/logo.png" id="icon" alt="User Icon" style="height: 250px;" />
                    <div class="clearfix"></div>
                </div>
            </div>
        </center>
    </div>

</div>
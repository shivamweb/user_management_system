<html>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="{{ asset('/css/login_style.css') }}" rel="stylesheet">
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };
    </script>
    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <div class="wrapper fadeInDown">
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
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="image/logo.png" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form method="post" action="{{ url('/checklogin') }}" enctype="multipart/form-data">
            @csrf
                <input type="text" id="login" class="fadeIn second" name="email" placeholder="login" required>
                <input type="text" id="password" class="fadeIn third" name="password" placeholder="password" required minlength="8">
                <input type="submit" class="fadeIn fourth" value="Log In">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="{{url('forgotPassword')}}">Forgot Password? </a> OR
                <a class="underlineHover" href="{{url('new-record')}}"> Create new Entry</a>
            </div>

        </div>
    </div>
</body>

</html>
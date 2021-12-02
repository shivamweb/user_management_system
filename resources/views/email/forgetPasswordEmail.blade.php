<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="{{ asset('/css/forgetPassword_style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container padding-bottom-3x mb-2 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="forgot">
                    <h2>Hello</h2>
                    <p>You are getting this mail because you have requested to reset the password. This mail will help you to  your password.</p>
                    <a href="{{ route('reset.password.get', $token) }}">Reset Password</a> 
                </div>
            </div>
        </div>
    </div>
</body>

</html>
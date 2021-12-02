<!DOCTYPE html>
<html lang="en">

<head>
    <title>New Record</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('/js/style.js') }}"></script>
</head>

<body>

    <div class="container col-sm-4" style="padding: 30px;background-color: #a9a9a92b;margin-top: 30px;">

        <h2 class="text-center">Fill your Details</h2>
        <form action="{{ isset($record_details) ?  url('update-record/'.$record_details->id) : route('recordsController.store') }}" method="POST" enctype="multipart/form-data" name="recordForm" onsubmit="return validateForm()">
            @csrf

            @if(isset($record_details))
            @method('PUT')
            @endif

            <div class="text-center">
                <img src="{{ isset($record_details) ? url('store_image/fetch_image/'.$record_details->id) : '/image/no-image.png' }}" id="output_image" width="150px" height="150px">
            </div>
            <div class="form-group text-center ">
                <input type="file" id="profile" name="profile" onchange="loadFile(event)" required>
                <lable id="image_error" class="text-danger"> @if ($errors->has('image_path')) {{ $errors->first('image_path') }} @endif</lable>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="@if (isset($record_details)){{$record_details->name}}@endif">
                <lable id="name_error" class="text-danger"> @if ($errors->has('name')) {{ $errors->first('name') }} @endif</lable>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" class="form-control" id="age" placeholder="Enter age" name="age" value="@if (isset($record_details)){{$record_details->age}}@endif">
                <label id="age_error" class="text-danger">@if ($errors->has('age')) {{ $errors->first('age') }} @endif</label>
            </div>
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" class="form-control" id="contact" placeholder="Enter Contact" name="contact" value="@if (isset($record_details)){{$record_details->contact}}@endif">
                <label id="contact_error" class="text-danger">@if ($errors->has('contact')) {{ $errors->first('contact') }} @endif</label>
            </div>
            <div class="form-group">
                <label for="contact">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="@if (isset($record_details)){{$record_details->email}}@endif">
                <label id="email_error" class="text-danger">@if ($errors->has('email')) {{ $errors->first('email') }} @endif</label>
            </div>
            @if (!isset($record_details))
            <div class="form-group">
                <label for="contact">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" value="@if (isset($record_details)){{$record_details->password}}@endif">
                <label id="password_error" class="text-danger">@if ($errors->has('password')) {{ $errors->first('password') }} @endif</label>
            </div>
            @endif
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                @if (!isset($record_details))
                <br><a href="{{url('login')}}"> Already registered? back to login.</a>
                @else
                <br><a href="{{url('records')}}"> Back to Dashboard.</a>
                @endif
            </div>
        </form>
    </div>

</body>

</html>
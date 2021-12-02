<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
            @endif
        </div>
        <div class="row">
            <h2>All records</h2>
            <a href="{{ route('logout')}}"><button class="button button1" type="button" style="float: right;">Logout</button></a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Image</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th class="text-center" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center"><img src="store_image/fetch_image/{{ $record->id }}" width="50px" height="50px"></td>
                        <td>{{$record->name}}</td>
                        <td>{{$record->age}}</td>
                        <td>{{$record->contact}}</td>
                        <td>{{$record->email}}</td>
                        <td class="text-center"><a href="{{ url('change-password')}}" class="btn btn-primary">Change Password</a></td>
                        <td class="text-center"><a href="{{ route('recordsController.edit', $record->id)}}" class="btn btn-primary">Edit</a></td>
                        <td class="text-center"><a href="{{ route('delete',['id'=>$record->id])}}" class="btn btn-danger" onclick="return confirm('Are you sure, you want to delete?')">Delete</a></td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
</body>

</html>
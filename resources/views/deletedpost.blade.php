<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/post.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="header">
        <img src="image/logo.png" class="logo" id="icon" alt="User Icon" style="width: 50px; height:50px;" /></a>
        <div class="header-right">
            <a href="{{url('records')}}">Dashboard</a>
            <a href="{{url('new-post')}}">New Post</a>
            <a href="{{url('post')}}">View Post</a>
            <a class="active" href="{{url('deleted-post')}}">Deleted Post</a>
            <a href="{{ route('logout')}}"> Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
            @endif
        </div>
    </div>
    <div class="center">
        <h1 class="center">Your Deleted Post</h1>
        @foreach( $posts as $post)
        <div class="row" style="border: 3px solid rgb(212, 212, 212); padding:20px ">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="media mb-3">
                        <img src="{{url('store_image/fetch_image/'.$post->user->id)}}" class="d-block ui-w-40 rounded-circle" alt="" style="border-radius: 25px; height:40px; width:40px;">
                        {{ $post->user->name}}
                        
                        <a href="{{ route('post-restore',['id'=>$post->id])}}" onclick="return confirm('Are you sure, you want to restore this post?')" style="float: right;">
                        <button type="button" class="btn btn-success btn-sm">Restore</button>
                        </a> 

                        <div class="media-body ml-3">
                            <div class="text-muted small">{{ $post->created_at }}</div>
                        </div>
                    </div>
                    <hr>

                    @foreach($post->post_photo as $image )
                    <img src="/image/{{$image->image}}" style=" width: 100%; height: 300px;">
                    @endforeach
                </div>
                <div class="card-footer">
                    <p>{{ $post->title}}</p>
                    <a href="{{ url('comments/'.$post->id)}}" class="d-inline-block text-muted ml-3">
                        <small class="align-middle">
                            <strong>12</strong> Comments</small>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>

</html>
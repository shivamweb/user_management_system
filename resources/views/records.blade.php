@extends('user-master')

@section('title', 'User Dashboard')

@section('content')

<div class="row">
    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif
</div>
<div class="row">
    <h2>All records</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">Image</th>
                <th>Name</th>
                <th>Age</th>
                <th>Contact</th>
                <th>Email</th>
                <th class="text-center" colspan="2">Action</th>
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
            </tr>
        </tbody>
    </table>
</div>
@endsection
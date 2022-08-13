@extends('layouts.guest')
@section('content')
  <form action="{{route('board.update' , $response->id)}}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="text" class="form-control" value="{{$response->name}}" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="text" class="form-control" value="{{$response->desc}}" name="desc" id="exampleInputPassword1" placeholder="Password">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
@extends('layouts.guest')
@section('content')
  <form action="{{route('trello.card.store' , $id)}}" method="post">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
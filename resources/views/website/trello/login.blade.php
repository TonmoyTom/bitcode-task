@extends('layouts.guest')
@section('content')
<div class="wrapper">
  <form class="form-signin"  action="{{route('trello.login.submit')}}" method="POST">
    @csrf
    <h2 class="form-signin-heading">Please login</h2>
    <input type="text" class="form-control" name="key" placeholder="Api Key" />
    <input type="text" class="form-control" name="token" placeholder="token" />
    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
  </form>
@endsection



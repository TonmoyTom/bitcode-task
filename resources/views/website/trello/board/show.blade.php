@extends('layouts.guest')
@section('content')
  <div class="wrapper">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <h1>Board List Information</h1>
        <div class="card-toolbar">
          <a href="{{route('trello.card.create', $id)}}">Create Card</a>
        </div>
        <table id="myTable" class="table table-bordered" width="100%">
          <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>

          @foreach($response as $res)
            <tr>
              <td>{{$res->id}}</td>
              <td>{{$res->name}}</td>
              <td>
                <a href="{{route('trello.card.child.list' , $res->id)}}">Show</a>|
              </td>
            <tr>
          @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
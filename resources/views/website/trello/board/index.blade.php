@extends('layouts.guest')
@section('content')
  <div class="wrapper">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <h1>Board List Information</h1>
        <div class="card-toolbar">
          <a href="{{route('board.create')}}">Create Board</a>
        </div>
        <table id="myTable" class="table table-bordered" width="100%">
          <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Des</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>

           @foreach($response as $res)
             <tr>
              <td>{{$res->id}}</td>
              <td>{{$res->name}}</td>
              <td>{{$res->desc}}</td>
              <td>
                <a href="{{route('board.edit' , $res->id)}}">Edit</a>|
                <a href="{{route('board.show' , $res->id)}}">Show</a>|
                <form method="POST" action="{{ route('board.destroy' ,$res->id )}}">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-primary font-weight-bolder">Delete</button>
                </form>

              </td>
             <tr>
          @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

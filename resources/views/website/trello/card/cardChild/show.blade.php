@extends('layouts.guest')
@section('content')
  <div class="wrapper">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <h1>Board List Information</h1>
        <table id="myTable" class="table table-bordered" width="100%">
          <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Des</th>
          </tr>
          </thead>
          <tbody>  
            <tr>
              <td>{{$response->id}}</td>
              <td>{{$response->name}}</td>
              <td>{{$response->desc}}</td>
            <tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
@extends('layouts.guest')
@section('content')
  <div class="wrapper">
    <div class ="row justify-content-center">
      <div class="col-lg-8">
      <form action="{{route('trello.set.organizations')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Select Organization</label>
          <select class="form-control select2_multiple" id="org_id" name="org_id">
          <option value="">Select Organization</option>
              @foreach($response as $res)
                  <option value="{{ $res->id }}" {{(org() ==  $res->id) ? 'selected' : ''}} >{{ $res->name }}</option>
              @endforeach
          </select>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <h1>Profile Information</h1>
        <table id="myTable" class="table table-bordered" width="100%">
          <thead>
          <tr>
            <th> Id</th>
            <th>Name</th>
            <th>fullName</th>
            <th>email</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>{{$information->id}}</td>
            <td>{{$information->username}}</td>
            <td>{{$information->fullName}}</td>
            <td>{{$information->email}}</td>
          <tr>
          </tbody>
        </table>
      </div>
      <div class="col-lg-6">
        <h1>Organization Information</h1>
        <table id="myTable" class="table table-bordered" width="100%">
          <thead>
          <tr>
            <th> Id</th>
            <th>Name</th>
            <th>Display Name</th>
          </tr>
          </thead>
          <tbody>
          @foreach($response as $res)
            <tr>
              <td>{{$res->id}}</td>
              <td>{{$res->name}}</td>
              <td>{{$res->displayName}}</td>
            <tr>
          @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@extends('layouts.guest')

@section('content')

  <div class="card card-custom card-sticky" id="kt_page_sticky_card">
    <div class="card-header">
      <div class="card-title">
        <h3 class="card-label">Purchase Data </h3>
      </div>
      @if (session()->has('success'))
        <div class="alert alert-success custom-notify">
          <div class="d-flex align-items-center">
            <i class="far fa-check-circle mr-2 text-white"></i>{{ session()->get('success') }}
          </div>
        </div>
      @endif
      <div class="card-toolbar">
      <form method="POST" action="{{ route('purchase.store')}}">
        @csrf
        <button type="submit" class="btn btn-primary font-weight-bolder">Purchase Store</button>
      </form>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          @if (session()->has('purchase'))
            <ul>
              @foreach(session()->get('purchase') as $key => $purchase)
              <li class="alert alert-danger">{{ $purchase }}</li>
              @endforeach
            </ul>
          @endif
          <table id="myTable" class="table table-bordered" width="100%">
            <thead>
            <tr>

              <th>Product Name</th>
              <th>Customer Name</th>
              <th>purchase_quantity</th>
              <th>product_price</th>
              <th>Total</th>

            </tr>
            </thead>
            <tbody>
            @forelse($purchases as $purchase)
                <tr>
                  <td>{{$purchase->product_name}}</td>
                  <td>{{$purchase->name}}</td>
                  <td>{{$purchase->quantity}}</td>
                  <td>{{$purchase->product_price}}</td>
                  <td>{{$purchase->total}}</td>

              <tr>
            @empty
              <tr>
                <td colspan="2">
                  no Data found!
                </td>
              </tr>
            @endforelse
            <tr>
              <td colspan="2" class="text-right">Gross Profit</td>
              <td >{{$purchases->sum('quantity')}}</td>
              <td>{{$purchases->sum('product_price')}}</td>
              <td >{{$purchases->sum('total')}}</td>
            <tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('script')

@endpush

@extends('layouts.app')
@section('content')
{{-- <form action="/deliverCustomerOrder" method="POST"> --}}
<form action="/uploadInvoiceCustomerOrder" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
@csrf
@method('POST')
  <div class="row py-2">
    <div class="col-md-12">
      <div class="card shadow-sm">
        <div class="card-header">
          Customer Order Info
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <strong>Invoice No:</strong>
            <br>
              {{ $order->invoice_no }}
            </div>
      
            <div class="col-md-2">
              <label class="form-check-label">
                              
                <input type="checkbox" class="form-check-input" name="urgent_order" id="urgent_order" value="{{$order->urgent_order}}" {{$order->urgent_order == 1?'checked':''}}>
                Urgent Order
              </label>
            </div>
            <div class="col-md-2">
                <strong>Biller Address:</strong>
            <br>
                {{ $order->biller_address }}
            </div>
      
            <div class="col-md-2">
                <strong>Delivery Address:</strong>
            <br>
                {{ $order->delivery_address }}
            </div>
      
            
            <div class="col-md-2">
              <strong>Customer Name:</strong>
            <br>
            @foreach ($order->customer as $item)
                
                {{$item->user->name}}
                  
              @endforeach
            </div>
          </div>
          <hr>
          <div class="row mb-2">
            <div class="col-md-12">
              <h2>Order Informations</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Item No</th>
                    {{-- <th>Pack Size</th> --}}
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Remark</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($order->orderRequest as $key => $order_request)
                    <tr>
                      <td scope="row">{{$key + 1}}</td>
                      <td>{{$order_request->item_no}}</td>
                      {{-- <td>{{$order_request->pack_size}}</td> --}}
                      <td>{{$order_request->description}}</td>
                      <td>{{$order_request->quantity}}</td>
                      <td>{{$order_request->remark}}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6">No Order Items</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        <div class="col-md-12">
          @isset($order->invoice)
          <div class="float-right">
          <a href="{{ route('invshow').'?invoice='.$order->invoice }}" target="_blank" class="btn btn-success btn-sm">Open Invoice</i></a>
          </div>
        @endisset
        </div>
          {{-- @if (isset($order->invoice))
            <div class="row">
              <div class="col-8">
                <embed src="{{ asset('invoices/'.$order->invoice) }}" type="application/pdf" width="100%" style="height:50vh;">            
              </div>
            </div>
          @endif --}}
          <div class="row mt-4">
            <div class="col-xs-12 col-sm-12 col-md-12 ">
              <a class="btn btn-secondary" href="{{ route('orders.index') }}">Back</a>
              <input type="hidden" name="customerOrder_id" value="{{$order->id}}">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@push('scripts')
  <script src="{{asset('js/validate.js')}}"></script>
  <script>
    $(document).ready(function(){
      $(".btn").click(function(){
      
        $("a").fadeToggle("slow");
       
      });
    });
    </script>
@endpush
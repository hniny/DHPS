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
              {{ $customerOrder->invoice_no }}
            </div>
      
            <div class="col-md-3">
                <strong>Biller Address:</strong>
            <br>
                {{ $customerOrder->biller_address }}
            </div>
      
            <div class="col-md-3">
                <strong>Delivery Address:</strong>
            <br>
                {{ $customerOrder->delivery_address }}
            </div>
      
            <div class="col-md-3">
                <strong>Customer Name:</strong>
            <br>
                {{ $customerOrder->customer->first()->user->name }}
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
                  @forelse ($customerOrder->orderRequest as $key => $order)
                    <tr>
                      <td scope="row">{{$key + 1}}</td>
                      <td>{{$order->item_no}}</td>
                      {{-- <td>{{$order->pack_size}}</td> --}}
                      <td>{{$order->description}}</td>
                      <td>{{$order->quantity}}</td>
                      <td>{{$order->remark}}</td>
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
          @if (isset($customerOrder->invoice))
            <div class="row">
              <div class="col-8">
                <embed src="{{ asset('invoices/'.$customerOrder->invoice) }}" type="application/pdf" width="100%" style="height:50vh;">            
              </div>
            </div>
          @endif
          @php
            $start_time = strtotime($customerOrder->created_at);
            $now = strtotime(date('Y-m-d h:i:s'));
            $diff = round(($now - $start_time)/3600, 1);
          @endphp
          @if ($diff >= 24)
            <div class="form-row">
              <div class="form-group col-2">
                {{-- <div class="custom-file"> --}}
                  <label for="">Upload File</label>
                  <input type="file" name="invoice" id="invoice" {{ !isset($customerOrder->invoice) ? 'required' : '' }}>
                  {{-- <label class="custom-file-label" for="invoice">Choose file</label> --}}
                {{-- </div>   --}}
                  <div class="invalid-feedback">
                    Pleas choose a file.
                  </div>
              </div>
            </div>
          @endif
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 ">
              <a class="btn btn-secondary" href="{{ route('customer-orders.index') }}">Back</a>
              <input type="hidden" name="customerOrder_id" value="{{$customerOrder->id}}">
              @if (!isset($customerOrder->delivered_at))
                <button type="submit" class="btn btn-primary">Submit</button>
              @endif
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
@endpush
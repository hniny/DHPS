@extends('layouts.app')
@section('content')

<div class="row my-2">
  <div class="form-group col-3">
    <select name="invoice" id="invoice" class="form-control">
      <option value="">ဘောင်ချာနံပါတ်</option>
      @foreach ($invoices as $key => $inv)

        @if ($invoice == $inv)
          <option value="{{ $inv }}" selected>{{ $inv }}</option>
        @else
          <option value="{{ $inv }}">{{ $inv }}</option>
        @endif
          
      @endforeach
    </select>
  </div>

  <div class="form-group col-3">
    <input type="date" class="form-control" name="date" id="date" value="{{ $date }}">
  </div>
  
  <div class="form-group col-3">
    <button class="btn btn-primary" type="button" id="search">ရှာရန်</button>
  </div>

</div>
<div class="row ">
  <div class="col-md-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="true">Order List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="warehouse-tab" data-toggle="tab" href="#warehouse" role="tab" aria-controls="warehouse" aria-selected="false">Completed</a>
      </li>
      
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="order-tab">
       
        @forelse ($customerOrders as $customerOrder)
        <div class="border bg-white rounded shadow-sm p-3 mb-2"> 
            <div class="row">
                <div class="col-6 col-md-2">
                  <span class="text-secondary">နေ့စွဲ</span> <br>
                  {{date('Y-m-d', strtotime($customerOrder->created_at))}}
                </div>
                <div class="col-4 col-md-2">
                    <span class="text-secondary"> ဘောင်ချာနံပါတ်</span> <br>
                    {{$customerOrder->invoice_no}}
                </div>
                <div class="col-4 col-md-2">
                    <span class="text-secondary">အရေအတွက်</span> <br>
                    {{$customerOrder->order_request_count}}
                </div>
                
                <div class="col-4 col-md-3">
                    <span class="text-secondary">ငွေတောင်းခံသည့်လိပ်စာ</span> <br>
                    {{$customerOrder->biller_address}}
                </div>
                <div class="col-6 col-md-3 text-right my-2">
                    <form action="{{ route('customer-orders.destroy', $customerOrder->id) }}" method="POST">
                      {{-- @php
                        $start_time = strtotime($customerOrder->created_at);
                        $now = strtotime(date('Y-m-d h:i:s'));
                        $diff = round(($now - $start_time)/3600, 1);
                      @endphp
                      @if ($diff >= 24) --}}
                        {{-- <a class="btn btn-sm btn-danger" href="{{ route('customer-orders.show',$customerOrder->id) }}">
                          <i class="lni lni-eye"></i>
                        </a> --}}
                      {{-- @else --}}
                        <a class="btn btn-sm btn-info" href="{{ route('customer-orders.show',$customerOrder->id) }}">
                          <i class="lni lni-eye"></i>
                        </a>
                      {{-- @endif --}}
                        
                        
                        @can('customerOrder-list')
                              <a class="btn btn-secondary btn-sm " href="/delivery/{{$customerOrder->id}}">Delivery</a>
                                  
                              @endcan
                    </form>
                </div>
            </div>
        </div>
        @empty
          <div class="border bg-white rounded shadow-sm p-3 mb-2">
            <div class="row">
              <div class="col-12 text-center p-5">
                <span class="text-danger font-weight-bold">Data Empty!</span>
              </div>
            </div>
          </div>
        @endforelse
        {!! $customerOrders->links() !!}
      </div>
      {{-- ******************************************************************* --}}
      <div class="tab-pane fade" id="warehouse" role="tabpanel" aria-labelledby="warehouse-tab">
        @forelse ($deliveries as $customerOrder)
        <div class="border bg-white rounded shadow-sm p-3 mb-2"> 
            <div class="row">
                <div class="col-6 col-md-2">
                  <span class="text-secondary">နေ့စွဲ</span> <br>
                  {{date('Y-m-d', strtotime($customerOrder->created_at))}}
                </div>
                <div class="col-4 col-md-2">
                    <span class="text-secondary"> ဘောင်ချာနံပါတ်</span> <br>
                    {{$customerOrder->invoice_no}}
                </div>
                <div class="col-4 col-md-2">
                    <span class="text-secondary">အရေအတွက်</span> <br>
                    {{$customerOrder->order_request_count}}
                </div>
                
                <div class="col-4 col-md-3">
                    <span class="text-secondary">ငွေတောင်းခံသည့်လိပ်စာ</span> <br>
                    {{$customerOrder->biller_address}}
                </div>
                <div class="col-6 col-md-3 text-right my-2">
                    <form action="{{ route('customer-orders.destroy', $customerOrder->id) }}" method="POST">
                      {{-- @php
                        $start_time = strtotime($customerOrder->created_at);
                        $now = strtotime(date('Y-m-d h:i:s'));
                        $diff = round(($now - $start_time)/3600, 1);
                      @endphp
                      @if ($diff >= 24) --}}
                        {{-- <a class="btn btn-sm btn-danger" href="{{ route('customer-orders.show',$customerOrder->id) }}">
                          <i class="lni lni-eye"></i>
                        </a>
                      @else --}}
                        <a class="btn btn-sm btn-info" href="{{ route('customer-orders.show',$customerOrder->id) }}">
                          <i class="lni lni-eye"></i>
                        </a>
                      {{-- @endif --}}
                        
                       
                       
                    </form>
                </div>
            </div>
        </div>
        @empty
          <div class="border bg-white rounded shadow-sm p-3 mb-2">
            <div class="row">
              <div class="col-12 text-center p-5">
                <span class="text-danger font-weight-bold">Data Empty!</span>
              </div>
            </div>
          </div>
        @endforelse
        {!! $customerOrders->links() !!}
      </div>
      {{-- ******************************************************************* --}}
    </div>
     
  </div>
</div>

    
@endsection

@push('scripts')
    <script>
      $(document).ready(function () {
        $('#search').on('click', function () {
          var invoice = $('#invoice').val();
          var date = $('#date').val();
          window.location.href = '/warehouse?invoice='+invoice+'&&date='+date;
        });
      });
    </script>
@endpush
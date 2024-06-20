@extends('layouts.app')
@section('content')
<div class="row py-2">
   
</div>
<div class="row my-2">
  <div class="form-group col-md-2">
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

  {{-- <div class="form-group col-md-3">
    <input type="date" class="form-control" name="date" id="date" value="{{ $date }}">
  </div> --}}

  <label for="from" class="col-form-label">From</label>
  <div class="col-md-2">
  <input type="date" class="form-control input-sm" id="from" name="from" value="{{$from}}">
  </div>
  <label for="from" class="col-form-label">To</label>
  <div class="col-md-2">
      <input type="date" class="form-control input-sm" id="to" name="to" value="{{$to}}"">
  </div>

  <div class="form-group col-md-3">
    <button class="btn btn-primary btn-sm" type="button" id="search">ရှာရန်</button>
    {{-- <a class="btn btn-success btn-sm" href="{{ route('weeklyReport') }}">Weekly Report</a> --}}
    <button id="export" class="btn btn-sm btn-success" class="form-control">Export</button>
  </div>

  <div class="col-md-2 text-right">
     
    @can('customerOrder-create')
      <a class="btn btn-success btn-md " href="{{ route('customer-orders.create') }}">Create New</a>
    @endcan
  </div>

</div>


  {{-- <form action="weekly_reports" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container">
    <div class="row">
      <div class="form-group col-md-3">
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
    <label for="from" class="col-form-label">From</label>
        <div class="col-md-2">
        <input type="date" class="form-control input-sm" id="from" name="from">
        </div>
        <label for="from" class="col-form-label">To</label>
        <div class="col-md-2">
            <input type="date" class="form-control input-sm" id="to" name="to">
        </div>
        
               
        <div class="col-md-3">
           <button type="submit" class="btn btn-primary btn-sm" name="search" id="search">Search</button>
            <button type="submit" class="btn btn-secondary btn-sm" name="exportPDF">export PDF</button>
            <button type="submit" class="btn btn-success btn-sm" name="exportExcel">export Excel</button>

        </div>
    </div>
</div>
</form><br> --}}


{{-- <div class="text-right">
  <div class="row">
    <input type="date" class="form-control" name="date" id="fdate"  style="width:200px">
    <input type="date" class="form-control" name="date" id="tdate"  style="width:200px">
    <a href="/dailyOrder" id="export" class="btn btn-md btn-primary"><i class="fa fa-download pr-1"></i>Daily</a>
  </div>
  
  <a href="/monthlyOrder" class="btn btn-md btn-primary"><i class="fa fa-download pr-1"></i>Monthly</a>
</div> --}}

<div class="row ">
  <div class="col-md-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="true">Order List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="warehouse-tab" data-toggle="tab" href="#warehouse" role="tab" aria-controls="warehouse" aria-selected="false">Warehouse</a>
      </li>
      
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="order-tab">
       
        @forelse ($customerOrders as $customerOrder)
        <div class="border bg-white rounded shadow-sm p-3 mb-2"> 
          <div class="row">
            
              @if ($customerOrder->urgent_order == 1)
              <div class="col-md-12">
                <div class="btn btn-sm text-white bg-secondary">Urgent Order</div>
              </div>
              @endif
            
          <div class="col-6 col-md-2">
              <span class="text-secondary">Customer အမည်</span> <br>
              @foreach ($customerOrder->customer as $item)
                
                {{$item->user->name}}
                  
              @endforeach
            </div>
              <div class="col-6 col-md-2">
                <span class="text-secondary">နေ့စွဲ</span> <br>
                {{date('Y-m-d', strtotime($customerOrder->created_at))}}
              </div>
              <div class="col-4 col-md-2">
                  <span class="text-secondary"> ဘောင်ချာနံပါတ်</span> <br>
                  {{$customerOrder->invoice_no}}
              </div>
              <div class="col-4 col-md-1">
                  <span class="text-secondary">အရေအတွက်</span> <br>
                  {{$customerOrder->order_request_count}}
              </div>
              
              <div class="col-4 col-md-2">
                  <span class="text-secondary">ငွေတောင်းခံသည့်လိပ်စာ</span> <br>
                  {{$customerOrder->biller_address}}
              </div>
              <div class="col-6 col-md-3 text-right my-2">
                  <form action="{{ route('customer-orders.destroy', $customerOrder->id) }}" method="POST">
                @if ($customerOrder->urgent_order == 1)
                {{-- ------------------------------------------- --}}
                    @if ($customerOrder->status !== 3)
                      <a class="btn btn-sm btn-danger" href="{{ route('customer-orders.show',$customerOrder->id) }}">
                        <i class="lni lni-eye"></i>
                      </a>
                    @else
                     
                      <a class="btn btn-sm btn-success" href="{{ route('customer-orders.show',$customerOrder->id) }}">
                        <i class="lni lni-eye"></i>
                      </a>
                      @can('customerOrder-list')
                              <a class="btn btn-secondary btn-sm " href="/warehouse/{{$customerOrder->id}}">Warehouse</a>
                                  
                      @endcan
                    @endif
                  {{-- --------------------------------------------- --}}
                    @else
                    {{-- -------------------------------------------- --}}
                      @php
                      $start_time = strtotime($customerOrder->created_at);
                      $now = strtotime(date('Y-m-d h:i:s'));
                      $diff = round(($now - $start_time)/3600, 1);
                      @endphp
                      @if ($diff >= 24)
                      {{-- --------------------------------------------- --}}
                      {{-- invoice uploaded --}}
                      @if ($customerOrder->status !== 3)
                      {{-- ------------------------ --}}
                      <a class="btn btn-sm btn-danger" href="{{ route('customer-orders.show',$customerOrder->id) }}">
                        <i class="lni lni-eye"></i>
                      </a>
                      @else
                     
                      <a class="btn btn-sm btn-success" href="{{ route('customer-orders.show',$customerOrder->id) }}">
                        <i class="lni lni-eye"></i>
                      </a>
                      @can('customerOrder-list')
                              <a class="btn btn-secondary btn-sm " href="/warehouse/{{$customerOrder->id}}">Warehouse</a>
                                  
                        @endcan
                      @endif
                      {{-- ------------------------------------- --}}
                    @else
                      <a class="btn btn-sm btn-info" href="{{ route('customer-orders.show',$customerOrder->id) }}">
                        <i class="lni lni-eye"></i>
                      </a>
                    @endif
                @endif

                      @can('customerOrder-edit')
                        <a class="btn btn-sm btn-primary" href="{{ route('customer-orders.edit',$customerOrder->id) }}"><i class="lni lni-pencil-alt"></i></a>
                      @endcan
                      @csrf
                      @method('DELETE')
                      @can('customerOrder-delete')
                          <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"><i class="lni lni-trash"></i></button>
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
                <span class="text-secondary">Customer အမည်</span> <br>
                @foreach ($customerOrder->customer as $item)
                  
                  {{$item->user->name}}
                    
                @endforeach
              </div>
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
                
                <div class="col-4 col-md-2">
                    <span class="text-secondary">ငွေတောင်းခံသည့်လိပ်စာ</span> <br>
                    {{$customerOrder->biller_address}}
                </div>
                <div class="col-6 col-md-2 text-right my-2">
                    <form action="{{ route('customer-orders.destroy', $customerOrder->id) }}" method="POST">
                      
                        <a class="btn btn-sm btn-info" href="{{ route('customer-orders.show',$customerOrder->id) }}">
                          <i class="lni lni-eye"></i>
                        </a>
                      
                       
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
         // $('#from').datepicker({
        //   uiLibrary: 'bootstrap4',
        //   format:'dd-mm-yyyy',
     
        // });
        // $('#to').datepicker({
        //   uiLibrary: 'bootstrap4',
        //   format:'dd-mm-yyyy',
    
        // }); 

        $('#search').on('click', function () {
          var invoice = $('#invoice').val();
          var from = $('#from').val();
          var to = $('#to').val();
          // var date = $('#date').val();
          window.location.href = '/customer-orders?invoice='+invoice+'&&from='+from+'&&to='+to;
        });

       
        $('#export').on('click',function(){
          // alert('hi');
          var from = $('#from').val();
          console.log(from);
          var to=$('#to').val();      
          if(from && to){
            window.location.href= "/weeklyReport?from="+from+"&to="+to;   
          }   
             
        });
      });
    </script>
@endpush
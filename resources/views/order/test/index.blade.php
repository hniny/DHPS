@extends('layouts.app')
@section('content')
<div class="row py-2">
  <div class="col-md-3 pt-2">
   <div class="form-group">
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
  </div>
  <div class="col-md-3 pt-2">
   <div class="form-group">
   <input type="date" name="date" id="date" class="form-control" value="{{$date}}">
   </div>
  </div>
  <div class="col-md-2 pt-2">
    <button class="btn btn-primary" type="button" id="search">ရှာရန်</button>
  </div>
   <div class="col-md-4 pt-2">
     <div class="float-right">
      @can('customerOrder-create')
      <a class="btn btn-success btn-sm w-100" href="{{ route('orders.create') }}">အော်ဒါမှာရန်</a>
    @endcan
   </div>
   </div>
</div>


    <div class="row ">
        <div class="col-md-12">
            @forelse ($orders as $order)
            <div class="border bg-white rounded shadow-sm p-3 mb-2">
                <div class="row">
                    <div class="col-md-2">
                      <span class="text-secondary">နေ့စွဲ</span> <br><br>
                      {{date('Y-m-d', strtotime($order->created_at))}}
                    </div>
                    <div class="col-md-2 ">
                        <span class="text-secondary">ဘောင်ချာနံပါတ်</span> <br><br>
                        {{$order->invoice_no}}
                    </div>
                    <div class="col-md-2 ">
                        <span class="text-secondary">အရေအတွက်</span> <br><br>
                        {{$order->order_request_count}}
                    </div>
                    
                    <div class="col-md-3 ">
                        <span class="text-secondary">ငွေတောင်းခံသည့်လိပ်စာ</span> <br><br>
                        {{$order->biller_address}}
                    </div>
                    <div class="col-md-3  text-right my-2">
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                            @isset($order->invoice)
                              <a href="{{ route('invdownload').'?invoice='.$order->invoice }}" class="btn btn-danger btn-sm"><i class="lni lni-download"></i></a>
                            @endisset
                            <a class="btn btn-sm btn-info" href="{{ route('orders.show',$order->id) }}">
                              <i class="lni lni-eye"></i></a>
                            @can('customerOrder-edit')
                              @php
                                $start_time = strtotime($order->created_at);
                                $now = strtotime(date('Y-m-d h:i:s'));
                                $diff = round(($now - $start_time)/3600, 1);
                              @endphp
                              @if ($diff < 24)
                                <a class="btn btn-sm btn-primary" href="{{ route('orders.edit',$order->id) }}"><i class="lni lni-pencil-alt"></i></a>
                              @endif
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
            {!! $orders->links() !!}
        </div>
    </div>
@endsection

@push('scripts')
<script>
  $(document).ready(function () {
    $('#search').on('click', function () {
      var invoice = $('#invoice').val();
      var date = $('#date').val();
      window.location.href = '/orders?invoice='+invoice+'&&date='+date;
    });
  });
</script>
@endpush
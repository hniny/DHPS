@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>{{ $title }}</h4>
            </div>
            <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- {{dd($order)}} --}}
            <form action="{{ route('orders.update',$order->id) }}" method="POST" class=" repeater needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong><span class="text-danger">*</span>Order No/ Invoice No:</strong>
                            <input type="text" name="invoice_no" class="form-control" placeholder="Order No/ Invoice No" value="{{$order->invoice_no}}" required>
                        </div>
                    </div>
                    <div class="col-md-2 pt-4">
                        <div class="form-check">
                            <label class="form-check-label">
                              
                              <input type="checkbox" class="form-check-input" name="urgent_order" id="urgent_order" value="{{$order->urgent_order}}" {{$order->urgent_order == 1?'checked':''}}>
                              Urgent Order
                            </label>
                          </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><span class="text-danger">*</span>Biller Address:</strong>
                            <textarea class="form-control" name="biller_address" id="" rows="3" required>{{$order->biller_address}}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><span class="text-danger">*</span>Delivery Address:</strong>
                            <textarea class="form-control" name="delivery_address" id="" rows="3" required>{{$order->delivery_address}}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-right mb-2">
                    <input data-repeater-create class="btn btn-success" type="button" value="ပစ္စည်းအသစ်ထည့်ရန်"/>
                </div>
                @php 
                $all=0;
                @endphp
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div data-repeater-list="order_items">
                        @foreach ($order->orderRequest as $order_request)  
                        <div data-repeater-item>                  
                            <div class="row border rounded bg-light py-3 mb-2">
                                <div class="col-6 col-md-3">     
                                <span class="text-secondary">
                                    ပစ္စည်း
                                </span>
                                <select name="description" id="description" class="form-control" required>                        
                                @foreach ($products as $product)                      
                                    <option value="{{ $product->detail }}"  {{$product->name == $order_request->item_no ?  'selected ': ''}} data-id="{{ $product->name }}" data-image="{{ $product->image }}"
                                    data-price="{{ $product->price }}">{{ $product->detail }}</option>
                                @endforeach
                                </select>
                                </div>
                                <div class="col-md-3 col-6">
                                    <span class="text-secondary">
                                        ပစ္စည်းနံပါတ်
                                    </span>                           
                                    <input type="text" class="form-control" id="item_no" name="item_no" value="{{ $order_request->item_no }}" readonly > 
                                </div>
                                <div class="col-md-3 col-6">
                                    <span class="text-secondary">
                                        ပစ္စည်းဓာတ်ပုံ
                                    </span>
                                    
                                <img  class="img-thumbnail" width="200" height="200" id="item_image" name="item_image" src="{{ asset('/uploads/'.$order_request->product->image) }}" />
                                    
                                </div>
                                <div class="col-6 col-md-3">
                                <span class="text-secondary">
                                    စျေးနုန်း
                                </span>
                                <input type="text"  value="{{$order_request->product->price}}" class="form-control" id="price" name="price" readonly required>
                                    <span class="text-secondary">
                                        အရေအတွက်
                                    </span>
                                <input type="number" name="quantity" class="form-control" placeholder="အရေအတွက်"  value="{{$order_request->quantity}}" required>
                                <span class="text-secondary">
                                    ကျသင့်ငွေ
                                </span>
                                @php                       
                                    $total=$order_request->product->price * $order_request->quantity;
                                    $all  +=  $total;                     
                                @endphp
                                <input type="number" name="total" id="total" class="form-control total" value="{{$total}}" readonly required>                            
                                </div>
                                <div class="col-12 col-md-12">
                                    <span class="text-secondary">
                                        မှတ်ချက်
                                    </span>
                                    <textarea class="form-control" name="remark" id="" placeholder="Remark" rows="3"></textarea>
                                
                            </div>
                            <div class="col-md-12 col-12 text-right mt-2">
                            <input class="btn btn-danger" type="button" value="Delete" onclick="deleteOrder({{$order_request->id}})"/>
                            </div>
                        </div>     
                        @endforeach        
                                    
                
                    </div>             
                    </div>
                    <div class="row ">
                    
                        <div class="col-9 col-sm-9 col-md-9 ">
                        </div>
                                        
                            <div class="col-3 col-sm-3 col-md-3  ">
                                <div class="form-group ">                              
                                <strong>စုစုပေါင်းကျသင့်ငွေ</strong><br>
                                <input type="text"  readonly class="form-control" name="all_total" id="all_total" value="{{$all}}">
                                </div>
                            </div>
                        

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 ">                
                        <div class="form-group">
                        <strong>Customer Note:</strong>
                        <textarea class="form-control" name="customer_note" id="customer_note" rows="3">{{$order->customer_note}}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                        <a class="btn btn-secondary" href="{{ route('orders.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>          
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{asset('js/validate.js')}}"></script>
    <script src="{{asset('js/repeater.js')}}"></script>
    <script>  
        function deleteOrder(orderID){
          if(confirm('Are you sure?')) {
            console.log('id',orderID);
            $.ajax({
                type: "POST",
                url: "/deleteOrderItem",
                data:
                {
                    orderID: orderID,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    if(result.success = true){
                        window.location.reload();
                    }
                    else{                        
                    }
                },
                error: function(result) {
                   // alert('error');
                }
            });
          }
        }
        $(document).ready(function () {
        $('.repeater').repeater({          
            isFirstItemUndeletable: true,        
            defaultValues: {
                'text-input': 'foo'
            },          
            show: function () {
                $(this).slideDown();
            },          
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },          
            ready: function (setIndexes) {             
            },           
            isFirstItemUndeletable: true
        });
      });
      function selectItemChange(index,name){     
        setItemNo(index);
        allSum();
      }    
   
      function setItemNo(index) {        
        var description = $('#description'+index+' option:selected');       
        var item_no = description.data('id');
        var item_image ='https://webapplication.dhps.com.mm/uploads/'+description.data('image'); 
        var price= description.data('price');
        $('#item_no'+index).val(item_no);
        $('#price'+index).val(price);
        $('#item_image'+index).attr('src', item_image);      
        var total=  price * $('#quantity'+index).val();
        $('#total'+index).val(total);                
      }
      function allSum(index){       
            var allTotal=0;
            $('.total').each(function(){
                allTotal+=parseInt($(this).val());
            });        
            $("#all_total").val( allTotal );         
      }
    </script>
@endpush
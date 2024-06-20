@extends('layouts.app')
@section('content')
<div class="row py-2">
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
                <form action="{{ route('orders.store') }}" method="POST" class=" repeater needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @if ($isTeamMember)
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <div class="form-group">
                                    <strong><span class="text-danger">*</span>Customer Name:</strong>
                                    <select class="form-control" name="customer_id" id="" required>
                                    <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}"> {{ isset($customer->user) ? $customer->user->name : '' }} </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong><span class="text-danger">*</span>အော်ဒါနံပါတ် / ဘောင်ချာနံပါတ်:</strong>                           
                                <input type="text" name="invoice_no" class="form-control" placeholder="Order No/ Invoice No" value="{{$invoice}}" required>
                            </div>
                        </div>
                       
                        <div class="col-md-2 pt-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                  
                                  <input type="checkbox" class="form-check-input" name="urgent_order" id="urgent_order" value=1>
                                  Urgent Order
                                </label>
                              </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong><span class="text-danger">*</span>ငွေတောင်းခံသည့်လိပ်စာ:</strong>
                                <textarea class="form-control" name="biller_address" id="" rows="3" required>{{$customer[0]}}</textarea>                         
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong><span class="text-danger">*</span>ပို့ရန်လိပ်စာ:</strong>
                                <textarea class="form-control" name="delivery_address" id="" rows="3" required>{{ $customer[0] }}</textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-right mb-2">
                            <input data-repeater-create class="btn btn-success" type="button" value="ပစ္စည်းအသစ်ထည့်ရန်"/>
                        </div>
                        <div class="col-12 col-md-12">
                            <div data-repeater-list="order_items">
                                <div data-repeater-item>                                
                                    <div class="row border rounded bg-light py-3 mb-2">
                                        <div class="col-6 col-md-3">     
                                        <span class="text-secondary">
                                            ပစ္စည်း
                                        </span>
                                        <select name="description" id="description" class="form-control" required>
                                            <option value="">ပစ္စည်း</option>
                                            @foreach ($products as $product)
                                        
                                            <option value="{{ $product->detail }}" data-id="{{ $product->name }}" data-image="{{ $product->image }}"
                                                data-price="{{ $product->price }}">{{ $product->detail }}</option>
                                            
                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <span class="text-secondary">
                                                ပစ္စည်းနံပါတ်
                                            </span>
                                            <input type="text" class="form-control" id="item_no" name="item_no" readonly required>
                                            
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <span class="text-secondary">
                                                ပစ္စည်းဓာတ်ပုံ
                                            </span>
                                            <img  class="img-thumbnail" width="200" height="200" id="item_image" name="item_image" />
                                            
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <span class="text-secondary">
                                                စျေးနုန်း
                                            </span>
                                            <input type="number" class="form-control" id="price" name="price" readonly required>
                                            <span class="text-secondary">
                                                အရေအတွက်
                                            </span>
                                            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="အရေအတွက်ထည့်ရန်" required>
                                            <span class="text-secondary">
                                                ကျသင့်ငွေ
                                            </span>
                                            <input type="number" name="total" id="total" class="form-control total" required>
                                        </div>
                                        <div class="col-12 col-md-12 pt-3">
                                            <span class="text-secondary">
                                                မှတ်ချက်
                                            </span>
                                            <textarea class="form-control" name="remark" id="" placeholder="မှတ်ချက်ရေးရန်" rows="3"></textarea>
                                        
                                    </div>
                                    <div class="col-md-12 col-12 text-right mt-2">
                                        <input data-repeater-delete class="btn btn-danger" type="button" value="Delete" />
                                    </div>
                                </div>                            
                            </div>
                            </div>
                    
                        <div class="row">
                            <div class="col-9">
                            </div>
                            <div class="col-3 col-sm-3 col-md-3  ">
                                <div class="form-group ">                              
                                <strong>စုစုပေါင်းကျသင့်ငွေ</strong><br>
                                <input type="text"  readonly class="form-control" name="all_total" id="all_total" >
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 ">
                                <div class="form-group">
                                <strong>Customerမှတ်စု:</strong>
                                <textarea class="form-control" name="customer_note" id="customer_note" rows="3">{{ old('customer_note') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 ">
                            <a class="btn btn-secondary" href="{{ route('orders.index')}}">နောက်သို့</a>
                            <button type="submit" class="btn btn-primary">အော်ဒါမှာသည်</button>
                        </div>
                    </div>
                </form>            
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{asset('js/validate.js')}}"></script>
    <script src="{{asset('js/repeater.js')}}"></script>
    <script>      
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
                // $dragAndDrop.on('drop', setIndexes);
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
@extends('layouts.app')
@section('content')
<div class="row py-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Retail Customer Informations</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">နာမည်အပြည့်အစုံ (Mr/Mrs/Miss):</strong> <br>
                        {{ $customer->user->name }}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">ရာထူး:</strong> <br>
                        {{ $customer->position }}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">ရုံးဆက်သွယ်ရန်နံပါတ်:</strong> <br>
                    {{ $customer->office_number}}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">ဆက်သွယ်ရန်နံပါတ်:</strong> <br>
                        {{ $customer->mobile_number}}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">အီးမေးလ်လိပ်စာ:</strong> <br>
                        {{ $customer->user->email }}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">ကုမ္ပဏီ / စီးပွားရေးအမည်:</strong> <br>
                        {{ $customer->componay_name }}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">ကုန်သွယ်ရေးအမည်:</strong> <br>
                        {{ $customer->trading_name }}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">ကုမ္ပဏီမှတ်ပုံတင်သည့်ရက်စွဲ:</strong> <br>
                        {{ $customer->company_registration_date }}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">ကုမ္ပဏီမှတ်ပုံတင်နံပါတ်:</strong> <br>
                        {{ $customer->company_registration_no }}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">Office Address/Postal Address:</strong> <br>
                        {{ $customer->office_address }}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">ပို့ရန်လိပ်စာ</strong> <br>
                        {{ $customer->delivery_address }}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">ဘဏ်</strong> <br>
                        {{ $customer->preferred_bank }}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">ငွေပေးချေစနစ်:</strong> <br>
                        {{ $customer->payment_method_name }}
                    </div>
                    <div class="col-md-3">
                        <strong class="text-muted">Customer Type:</strong> <br>
                        {{ $customer->customerType->name }}
                    </div>
                    <div class="col-md-3">
                        <strong class="text-muted">Outlet Type:</strong> <br>
                        {{ $customer->outletType->name }}
                    </div>
                </div>
                    <div class="row">
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">မှတ်ပုံတင်အရှေ့:</strong> <br>
                        <img src="{{ url('public/customer_files/'.$customer->applicant_id)}}" class="img-thumbnail" width="200" height="200"/>
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">မှတ်ပုံတင်အနောက်:</strong> <br>
                        <img src="{{ url('public/customer_files/'.$customer->applicant_id_one)}}" class="img-thumbnail" width="200" height="200"/>
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">အိမ်ထောင်စုစာရင်းအရှေ့:</strong> <br>
                        <img src="{{ url('public/customer_files/'.$customer->company_ref_id)}}" class="img-thumbnail" width="200" height="200"/>
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">အိမ်ထောင်စုစာရင်းအနောက်:</strong> <br>
                        <img src="{{ url('public/customer_files/'.$customer->company_ref_id_one)}}" class="img-thumbnail" width="200" height="200"/>
                    </div>

                    
                </div>
            
                <div class="row">
                    {{-- <div class="col-xs-2 col-sm-2 col-md-2 ">  
                    </div> --}}
                    @if($customer->user->status == 0)
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a class="btn btn-success btn-sm float-left mr-2" href="/customerstore/{{$customer->id}}">Confirm</a>
                        <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">
                            
                            @csrf
                            @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Deline</button>
                        </form> 
                    </div>

                    @else
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a class="btn btn-secondary btn-sm float-left mr-2" href="{{ route('customers.index') }}">Back</a>
                        <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">
                            @can('customer-edit')
                            <a class="btn btn-primary btn-sm pull-rigth" href="{{ route('customers.edit',$customer->id) }}"><i class="fa fa-edit"></i></a>
                            @endcan
                            @csrf
                            @method('DELETE')
                            @can('customer-delete')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            @endcan
                        </form> 
                    </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')


@section('content')
	<div class="row py-2">
		<div class="col-lg-12">
			<div class="card">
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
			
			
				<form action="{{ route('customers.update', $customer->id) }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
          @csrf
          @method('PUT')
					 <div class="row">
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Full Name<br>&nbsp;နာမည်အပြည့်အစုံ (Mr/Mrs/Miss):</strong>
								<input type="text" name="name" class="form-control" placeholder="Full Name (Mr/Mrs/Miss)" value="{{ isset($customer->user) ? $customer->user->name : ''}}" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
							  <strong><span class="text-danger">*</span>Position<br>&nbsp;ရာထူး:</strong>
							  <input type="text" name="position" class="form-control"  value="{{$customer->position}}" required>
							  
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Office Number<br>&nbsp;ရုံးဆက်သွယ်ရန်နံပါတ်:</strong>
								<input type="text" name="office_number" class="form-control" placeholder="09 xxxxxxxxx" value="{{$customer->office_number}}" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Mobile Number<br>&nbsp;ဆက်သွယ်ရန်နံပါတ်:</strong>
								<input type="text" name="mobile_number" class="form-control" placeholder="09 xxxxxxxxx" value="{{$customer->mobile_number}}" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong>Email Address<br>&nbsp;အီးမေးလ်လိပ်စာ:</strong>
								<input type="email" name="email" class="form-control" value="{{ isset($customer->user) ? $customer->user->email : ''}}" placeholder="Login Email Address">
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Company/Business Name<br>&nbsp;ကုမ္ပဏီ / စီးပွားရေးအမည်:</strong>
								<input type="text" name="componay_name" class="form-control" placeholder="Company/Business Name" value="{{$customer->componay_name}}" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Trading Name<br>&nbsp;ကုန်သွယ်ရေးအမည်:</strong>
								<input type="text" name="trading_name" class="form-control" placeholder="Trading Name" value="{{$customer->trading_name}}" required>
							</div>
						</div> <div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Company Registration Date<br>&nbsp;ကုမ္ပဏီမှတ်ပုံတင်သည့်ရက်စွဲ:</strong>
								<input type="text" name="company_registration_date" class="form-control" placeholder="XX / XX / XXXX" value="{{$customer->company_registration_date}}" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Company Registration No<br>&nbsp;ကုမ္ပဏီမှတ်ပုံတင်နံပါတ်:</strong>
								<input type="text" name="company_registration_no" class="form-control" placeholder="XXXXX" value="{{$customer->company_registration_no}}" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Preferred Bank<br>&nbsp;ဘဏ်:</strong>
							
								<select class="form-control" name="preferred_bank" id="preferred_bank" required>
									<option selected>ဘဏ်ရွေးချယ်ပါ</option>
									<option value="AYA">AYA</option>
									<option value="KBZ">KBZ</option>
									<option value="CB">CB</option>
								  </select>
								  
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
							  <strong><span class="text-danger">*</span>Payment Method<br>&nbsp;ငွေပေးချေစနစ်:</strong>
							  <select class="form-control" name="payment_method" id="payment_method" required>
								<option value="">ငွေပေးချေစနစ်ရွေးချယ်ပါ</option>
                @foreach ($payment_methods as $key => $payment_method)
                  @if ($key == $customer->payment_method)
                    <option value="{{$key}}" selected>{{$payment_method}}</option>
                  @else
                    <option value="{{$key}}">{{$payment_method}}</option>
                  @endif
								@endforeach
							  </select>
							</div>
            </div>
           </div>
           <div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3">
				<div class="form-group">
					<strong><span class="text-danger">*</span>City<br>&nbsp;မြို့:</strong>
					<select class="form-control" name="city" id="city" required>
					<option value="">မြို့ရွေးချယ်ပါ</option>
						@foreach ($cities as $key => $city)
						@if ($key == $customer->township->cities->id)
							<option value="{{$key}}" selected>{{$city}}</option>
						@else
							<option value="{{$key}}">{{$city}}</option>
						@endif
					@endforeach
					</select>
				</div>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3">
				<div class="form-group">
					<strong><span class="text-danger">*</span>Township<br>&nbsp;မြို့နယ်:</strong>
					<select class="form-control" name="township" id="township" required>
                  <option value="">မြို့နယ်ရွေးချယ်ပါ</option>
                  @foreach ($townships as $key => $township)
                    @if ($key == $customer->office_address)
                      <option value="{{ $key }}" selected>{{ $township }}</option>
                    @else
                      <option value="{{ $key }}">{{ $township }}</option>
                    @endif
                  @endforeach
                </select>
                <input type="hidden" name="postal_code" id="postal_code">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Customer Type <br>&nbsp;Customer
									အမျိုးအစား</strong>
								<select class="form-control" name="customer_type_id" id="customer_type_id" required>
								  <option value="">Choose Customer Type</option>
								  @foreach ($customerTypes as $key=>$customerType)
								  @if ($key == $customer->customerType->id)
									<option value="{{$key}}" selected>{{$customerType}}</option>
								@else
									<option value="{{$key}}">{{$customerType}}</option>
								@endif
								  @endforeach
								</select>
							  </div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Outlet Type<br>&nbsp;Outlet
									အမျိုးအစား</strong>
								<select class="form-control" name="outlet_type_id" id="outlet_type_id" required>
								  <option value="">Choose Outlet Type</option>
								  @foreach ($outletTypes as $key=>$outletType)
								  @if ($key == $customer->outletType->id)
								  <option value="{{$key}}" selected>{{$outletType}}</option>
							  @else
								  <option value="{{$key}}">{{$outletType}}</option>
							  @endif
									@endforeach
								</select>
							  </div>
						</div>
						{{-- <div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Office Address/Postal Address:</strong>
								<textarea class="form-control" style="height:150px" name="office_address" placeholder="Office Address/Postal Address" required></textarea>
							</div>
						</div> --}}
            
							<div class="col-xs-3 col-sm-3 col-md-3">
								<div class="form-group">
								 <strong><span class="text-danger">*</span>Applicant National ID Front<br>&nbsp;မှတ်ပုံတင်အရှေ့:</strong>
								<img src="{{asset('customer_files/'.$customer->applicant_id)}}" class="img-thumbnail" width="200" height="200"/>
								<input type="file" name="applicant_id" class="form-control" >
                    			<input type="hidden" name="hidden_image" value="{{ $customer->image }}">
								</div>
							 </div>
							
							 <div class="col-xs-3 col-sm-3 col-md-3">
							  <div class="form-group">
							   <strong><span class="text-danger">*</span>Applicant National ID Back<br>&nbsp;မှတ်ပုံတင်အနောက်:</strong>
							   <img src="{{asset('customer_files/'.$customer->applicant_id_one)}}" class="img-thumbnail" width="200" height="200"/>
							   <input type="file" name="applicant_id_one" class="form-control" >
                    			<input type="hidden" name="hidden_image" value="{{ $customer->image }}">
							  </div>
						   </div>
							 <div class="col-xs-3 col-sm-3 col-md-3">
								<div class="form-group">
								 <strong><span class="text-danger">*</span>Household List Front<br>&nbsp;အိမ်ထောင်စုစာရင်းအရှေ့:</strong>
								 <img src="{{asset('customer_files/'.$customer->company_ref_id)}}" class="img-thumbnail" width="200" height="200"/>
								 <input type="file" name="company_ref_id" class="form-control" >
                    <input type="hidden" name="hidden_image" value="{{ $customer->image }}">
								</div>
							 </div>
							 <div class="col-xs-3 col-sm-3 col-md-3">
							  <div class="form-group">
							   <strong><span class="text-danger">*</span>Household List Back<br>&nbsp;အိမ်ထောင်စုစာရင်းအနောက်:</strong>
							   <img src="{{asset('customer_files/'.$customer->company_ref_id_one)}}" class="img-thumbnail" width="200" height="200"/>
							   <input type="file" name="company_ref_id_one" class="form-control" >
                    <input type="hidden" name="hidden_image" value="{{ $customer->image }}">
							  </div>
						   </div>
						   
           <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">
               <strong><span class="text-danger">*</span>Delivery Address<br>&nbsp;ပို့ရန်လိပ်စာ</strong>
               <textarea class="form-control" style="height:150px" name="delivery_address" placeholder="Delivery Address" required>{{$customer->delivery_address}}</textarea>
             </div>
           </div>
						<div class="col-xs-3 col-sm-3 col-md-3 ">
							<a class="btn btn-secondary" href="{{ route('customers.index') }}"> ပယ်ဖျက်သည်
							</a>
							<button type="submit" class="btn btn-primary">ပြင်ဆင်သည်</button>
						</div>
					
				</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
<script src="{{asset('js/validate.js')}}"></script>
<script>
  $(document).ready(function () {
    $('#city').on('change', function () {
      var city = $(this).children('option:selected').val();
      $.ajax({

        type:'GET',

        url:'/city-townships',

        data:{city:city},

        success:function(data){

          if(data.success) {
            console.log(data);
            $('#township').html('<option value="">Choose Township</option>');
            $.each(data.townships, function (index, val) {
              $('#township').append('<option value="'+val.id+'" data-id="'+val.postal_code+'">'+val.name+'</option>');
            });
          } else {
            $('#township').html('<option value="">Choose Township</option>');
          }

        }

      });
      $('#postal_code').val('');
    });

    $('#township').on('change', function () {
      var postal_code = $(this).children('option:selected').data('id');
      if (postal_code) {
        $('#postal_code').val(postal_code);
      } else {
        $('#postal_code').val('');
      }
    });
  });
</script>
@endpush
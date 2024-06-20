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
			
			
				<form action="{{ route('customer-register') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
					@csrf
					 <div class="row">
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Full Name<br>&nbsp;နာမည်အပြည့်အစုံ (Mr/Mrs/Miss)</strong>
								<input type="text" name="name" class="form-control" placeholder="နာမည်အပြည့်အစုံ (Mr/Mrs/Miss)" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
							  <strong><span class="text-danger">*</span>Position<br>&nbsp;ရာထူး</strong>
							  <input type="text" name="position" class="form-control" placeholder="ရာထူးထည့်ရန်" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Office Number<br>&nbsp;ရုံးဆက်သွယ်ရန်နံပါတ်</strong>
								<input type="text" name="office_number" class="form-control" placeholder="09 xxxxxxxxx" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Contact Number<br>&nbsp;ဆက်သွယ်ရန်နံပါတ်</strong>
								<input type="text" name="mobile_number" class="form-control" placeholder="09 xxxxxxxxx" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong>Email Address<br>&nbsp;အီးမေးလ်လိပ်စာ</strong>
								<input type="email" name="email" class="form-control" placeholder="အီးမေးလ်လိပ်စာထည့်ရန်">
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Company/Business Name<br>&nbsp;ကုမ္ပဏီ / စီးပွားရေးအမည်</strong>
								<input type="text" name="componay_name" class="form-control" placeholder="ကုမ္ပဏီ / စီးပွားရေးအမည်" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Trading Name<br>&nbsp;ကုန်သွယ်ရေးအမည်</strong>
								<input type="text" name="trading_name" class="form-control" placeholder="ကုန်သွယ်ရေးအမည်" required>
							</div>
						</div> <div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Company Registration Date<br>&nbsp;ကုမ္ပဏီမှတ်ပုံတင်သည့်ရက်စွဲ</strong>
								<input type="date" name="company_registration_date" class="form-control"  required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Company Registration No<br>&nbsp;ကုမ္ပဏီမှတ်ပုံတင်နံပါတ်</strong>
								<input type="text" name="company_registration_no" class="form-control" placeholder="XXXXX" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Preferred Bank<br>&nbsp;ဘဏ်</strong>
								{{-- <input type="text" name="preferred_bank" class="form-control" placeholder="Preferred Bank" required> --}}
								<select class="form-control" name="preferred_bank" id="preferred_bank" required>
									<option selected>ဘဏ်ရွေးချယ်ပါ</option>
									<option value="1">AYA</option>
									<option value="2">KBZ</option>
									<option value="3">CB</option>
								  </select>
								  
							</div>
						</div>
						{{-- <div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Password:</strong>
								<input type="password" name="password" class="form-control" placeholder="Password" required>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Confirm Password:</strong>
								<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
							</div>
						</div> --}}
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
							  <strong><span class="text-danger">*</span>Payment Method<br>&nbsp;ငွေပေးချေစနစ်</strong>
							  <select class="form-control" name="payment_method" id="payment_method" required>
								<option value="">ငွေပေးချေစနစ်ရွေးချယ်ပါ</option>
								@foreach ($payment_methods as $key => $payment_method)
									  <option value="{{$key}}">{{$payment_method}}</option>
								@endforeach
							  </select>
							</div>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3">
				<div class="form-group">
					<strong><span class="text-danger">*</span>Payment Terms<br>&nbsp;ငွေပေးချေမှုသက်တမ်း</strong>
					<select class="form-control" name="payment_term" id="payment_term" required>
					  <option value="">ငွေပေးချေမှုသက်တမ်းရွေးချယ်ပါ</option>
					  @foreach ($payment_terms as $key => $payment_term)
							<option value="{{$key}}">{{$payment_term}}</option>
					  @endforeach
					</select>
				  </div>
			</div>
		   </div>
		   <div class="row">
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
							  <strong><span class="text-danger">*</span>City<br>&nbsp;မြို့</strong>
							  <select class="form-control" name="city" id="city" required>
								<option value="">မြို့ရွေးချယ်ပါ</option>
								@foreach ($cities as $key => $city)
									  <option value="{{$key}}">{{$city}}</option>
								@endforeach
							  </select>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="form-group">
							  <strong><span class="text-danger">*</span>Township<br>&nbsp;မြို့နယ်</strong>
							  <select class="form-control" name="township" id="township" required>
								<option value="">မြို့နယ်ရွေးချယ်ပါ</option>
				</select>
				<input type="hidden" name="postal_code" id="postal_code">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<strong><span class="text-danger">*</span>Customer Type <br>&nbsp;Customer အမျိုးအစား</strong>
								<select class="form-control" name="customer_type_id" id="customer_type_id" required>
								  <option value="">Choose Customer Type</option>
								  @foreach ($customerTypes as $key=>$customerType)
								<option value="{{$key}}">{{$customerType}}</option>
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
								  <option value="{{$key}}">{{$outletType}}</option>
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
					<strong><span class="text-danger">*</span>Applicant ID Front<br>&nbsp;မှတ်ပုံတင်အရှေ့</strong>
					<input type="file" class="form-control-file" name="applicant_id" id="applicant_id" placeholder="လျှောက်ထားသူ ID" aria-describedby="fileHelpId" required>
					<div class="invalid-feedback">
						မှတ်ပုံတင်အရှေ့ထည့်ပါ...
					</div>
				</div>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3">
				<div class="form-group">
				<strong><span class="text-danger">*</span>Applicant ID Back<br>&nbsp;မှတ်ပုံတင်အနောက်</strong>
				<input type="file" class="form-control-file" name="applicant_id_one" id="applicant_id_one" placeholder="လျှောက်ထားသူ ID" aria-describedby="fileHelpId" required>
				<div class="invalid-feedback">
					မှတ်ပုံတင်အနောက်ထည့်ပါ...
					</div>
				</div>
			</div>
				<div class="col-xs-3 col-sm-3 col-md-3">
				<div class="form-group">
					<strong><span class="text-danger">*</span>Household List Front<br>&nbsp;အိမ်ထောင်စုစာရင်းအရှေ့</strong>
					<input type="file" class="form-control-file" name="company_ref_id" id="company_ref_id" placeholder="ကုမ္ပဏီကိုးကားချက်" aria-describedby="fileHelpId" required>
					<div class="invalid-feedback">
						အိမ်ထောင်စုစာရင်းအရှေ့ထည့်ပါ...
					</div>
				</div>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3">
				<div class="form-group">
				<strong><span class="text-danger">*</span>Household List Back<br>&nbsp;အိမ်ထောင်စုစာရင်းအနောက်</strong>
				<input type="file" class="form-control-file" name="company_ref_id_one" id="company_ref_id_one" placeholder="ကုမ္ပဏီကိုးကားချက်" aria-describedby="fileHelpId" required>
				<div class="invalid-feedback">
					အိမ်ထောင်စုစာရင်းအနောက်ထည့်ပါ...
				</div>
				</div>
			</div>
			
		   <div class="col-xs-12 col-sm-12 col-md-12">
			 <div class="form-group">
			   <strong><span class="text-danger">*</span>Delivery Address<br>&nbsp;ပို့ရန်လိပ်စာ</strong>
			   <textarea class="form-control" style="height:150px" name="delivery_address" placeholder="ပို့ရန်လိပ်စာထည့်ရန်" required></textarea>
			 </div>
		   </div>
						<div class="col-xs-6 col-sm-6 col-md-6 ">
							<a class="btn btn-secondary" href="{{ route('customer_login') }}"> {{ __('messages.loginText') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('messages.registerText') }}</button>
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
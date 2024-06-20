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
		
		
			<form action="{{ route('customers.update',$customer->id) }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
				@csrf
				@method('PUT')
				 <div class="row">
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="form-group">
							<strong><span class="text-danger">*</span>Full Name (Mr/Mrs/Miss):</strong>
							<input type="text" name="name" class="form-control" placeholder="Full Name (Mr/Mrs/Miss)" value="{{ isset($customer->user) ? $customer->user->name : ''}}" required>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="form-group">
						  <strong><span class="text-danger">*</span>Position:</strong>
						  <select class="form-control" name="position_id" id="position_id" required>
							  <option value="">Choose Position</option>
							@foreach ($positions as $position)
								@if (isset($customer->position) && ($customer->position->id == $position->id))
									  <option value="{{$position->id}}" selected>{{$position->position_name}}</option>
								@else
									  <option value="{{$position->id}}">{{$position->position_name}}</option>
								@endif
							@endforeach
						  </select>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="form-group">
							<strong><span class="text-danger">*</span>Office Contact Number:</strong>
						<input type="text" name="office_number" class="form-control" placeholder="09 xxxxxxxxx" value="{{$customer->office_number}}" required>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="form-group">
							<strong><span class="text-danger">*</span>Mobile Contact Number:</strong>
							<input type="text" name="mobile_number" class="form-control" placeholder="09 xxxxxxxxx" value="{{$customer->mobile_number}}" required>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="form-group">
							<strong><span class="text-danger">*</span>Login Email Address:</strong>
							<input type="text" name="email" class="form-control" placeholder="Login Email Address" value="{{ isset($customer->user) ? $customer->user->email : ''}}" required>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="form-group">
							<strong><span class="text-danger">*</span>Company/Business Name:</strong>
							<input type="text" name="componay_name" class="form-control" placeholder="Company/Business Name" value="{{$customer->componay_name}}" required>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="form-group">
							<strong><span class="text-danger">*</span>Trading Name:</strong>
							<input type="text" name="trading_name" class="form-control" placeholder="Trading Name"  value="{{$customer->trading_name}}" required>
						</div>
					</div> <div class="col-xs-3 col-sm-3 col-md-3">
						<div class="form-group">
							<strong><span class="text-danger">*</span>Company Registration Date:</strong>
							<input type="text" name="company_registration_date" class="form-control" placeholder="XX / XX / XXXX" value="{{$customer->company_registration_date}}" required>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="form-group">
							<strong><span class="text-danger">*</span>Company Registration Number:</strong>
							<input type="text" name="company_registration_no" class="form-control" placeholder="XXXXX" value="{{$customer->company_registration_no}}" required>
						</div>
					</div>
					
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="form-group">
							<strong><span class="text-danger">*</span>Preferred Bank:</strong>
							<input type="text" name="preferred_bank" class="form-control" placeholder="Preferred Bank" value="{{$customer->preferred_bank}}" required>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3">
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
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="form-group">
						  <strong><span class="text-danger">*</span>Payment Method:</strong>
						  <select class="form-control" name="payment_method" id="payment_method" required>
							  <option value="">Choose Payment Method</option>
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
					<div class="col-xs-3 col-sm-3 col-md-3">
					   <div class="form-group">
							<strong><span class="text-danger">*</span>Applicant National ID:</strong>
							 <input type="file" class="form-control-file" name="applicant_id" id="applicant_id" placeholder="Applicant National ID" aria-describedby="fileHelpId" required>
							 <div class="invalid-feedback">
								Please upload your Applicant National ID image 
							  </div>
					   </div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3">
					   <div class="form-group">
							<strong><span class="text-danger">*</span>Company Reference:</strong>
							 <input type="file" class="form-control-file" name="company_ref_id" id="company_ref_id" placeholder="Company Reference" aria-describedby="fileHelpId" required>
							 <div class="invalid-feedback">
								Please upload your Company Reference image 
							 </div>
					   </div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<strong><span class="text-danger">*</span>Office Address/Postal Address:</strong>
							<textarea class="form-control" style="height:150px" name="office_address" placeholder="Office Address/Postal Address" required>{{$customer->office_address}}
							</textarea>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<strong><span class="text-danger">*</span>Delivery Address:</strong>
							<textarea class="form-control" style="height:150px" name="delivery_address" placeholder="Delivery Address" required>{{$customer->delivery_address}}
							</textarea>
						</div>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 ">
						<a class="btn btn-secondary" href="{{ route('customers.index') }}"> Back</a>
						<button type="submit" class="btn btn-primary">Update</button>
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
@endpush
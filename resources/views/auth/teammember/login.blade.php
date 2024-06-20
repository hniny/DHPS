@extends('layouts.app')
@section('content')
	<div class="row py-2">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4>{{ $title }}</h4>
				</div>
				<div class="card-body">
					
          <form action="{{ route('teamMember-login') }}" method="post">
            @csrf
            @method('POST')
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="user_name">အသုံးပြုသူအမည်</label>
                <input type="text" class="form-control" id="user_name" name="user_name">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="password">လျှို့ဝှက်နံပါတ်</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <button class="btn btn-primary">{{ __('messages.loginText') }}</button>
                <a href="{{ route('teamMember_register') }}" class="btn btn-secondary">{{ __('messages.registerText') }}</a>
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
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
			
          <form action="{{ route('cities.update', $city->id) }}" method="post" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="form-row">
              <div class="form-group col-3">
                <label for="name">City Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $city->name }}" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-3">
                <a href="{{ route('cities.index') }}" class="btn btn-secondary">Back</a>
                <button class="btn btn-primary">Submit</button>
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
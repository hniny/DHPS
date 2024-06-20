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
			
          <form action="{{ route('townships.update', $township->id) }}" method="post" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="form-row">
              <div class="form-group col-6">
                <label for="name">Township:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $township->name }}" required>
              </div>
              
              <div class="form-group col-6">
                <label for="name">Postal Code:</label>
                <input type="text" class="form-control" name="postal_code" id="postal_code" value="{{ $township->postal_code }}" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-6">
                <label for="name">City:</label>
                <select name="city_id" id="city_id" class="form-control" required>
                  <option value="">--Select City--</option>
                  @foreach ($cities as $id => $name)
                    @if ($id == $township->city_id)
                    <option value="{{ $id }}" selected>{{ $name }}</option>
                    @else
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>

              <div class="form-group col-6">
                <label for="name">City:</label>
                <select name="zone_id" id="zone_id" class="form-control" required>
                  <option value="">--Select City--</option>
                  @foreach ($zones as $id => $name)
                    @if ($id == $township->zone_id)
                    <option value="{{ $id }}" selected>{{ $name }}</option>
                    @else
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-3">
                <a href="{{ route('townships.index') }}" class="btn btn-secondary">Back</a>
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
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
			
          <form action="{{ route('zones.update', $zone->id) }}" method="post" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="form-row">
              <div class="form-group col-6">
                <label for="name">Zone Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $zone->name }}" required>
              </div>
              <div class="form-group col-6">
                <label for="name">City:</label>
                <select name="city_id" id="city_id" class="form-control" required>
                  
                  @foreach ($cities as $key => $city)
                    @if ($key == $zone->city_id)
                      <option value="{{ $key }}" selected>{{ $city }}</option>
                    @else
                      <option value="{{ $key }}">{{ $city }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-3">
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('zones.index') }}" class="btn btn-secondary">Cancel</a>
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
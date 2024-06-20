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
			
          <form action="{{ route('departments.update', $department->id) }}" method="post" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="form-row">
              <div class="form-group col-3">
                <label for="name">Department Name:</label>
                <input type="text" class="form-control" name="dep_name" id="dep_name" value="{{ $department->dep_name }}" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-3">
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back</a>
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
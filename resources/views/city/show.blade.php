@extends('layouts.app')
@section('content')
<div class="row py-2">
  <div class="col-lg-10">
    <div class="card">
      <div class="card-header">
        <h4>City Informations</h4>
      </div>
      <div class="card-body">
        <div class="row">
                
          <div class="col-md-3 mb-3">
            <strong class="text-muted">Name:</strong> <br>
            {{ $city->name }}
          </div>
        </div>
        <div class="row">
          <div class="col-xs-2 col-sm-2 col-md-2 ">
            <a class="btn btn-secondary" href="{{ route('cities.index') }}">Back</a>  
          </div>
        </div>
                
      </div>
    </div>
  </div>
</div>
@endsection
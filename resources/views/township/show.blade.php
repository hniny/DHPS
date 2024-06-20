@extends('layouts.app')
@section('content')
<div class="row py-2">
  <div class="col-lg-10">
    <div class="card">
      <div class="card-header">
        <h4>Consigment Informations</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3 mb-3">
            <strong class="text-muted">Name:</strong> <br>
            {{ $township->name }}
          </div>
        </div>
        <div class="row">   
          <div class="col-md-3 mb-3">
            <strong class="text-muted">City:</strong> <br>
            {{ isset($township->cities) ? $township->cities->name : '' }}
          </div>
        </div>
        <div class="row">   
          <div class="col-md-3 mb-3">
            <strong class="text-muted">Zone:</strong> <br>
            {{ isset($township->zones) ? $township->zones->name : '' }}
          </div>
        </div>
        <div class="row">   
          <div class="col-md-3 mb-3">
            <strong class="text-muted">Postal Code:</strong> <br>
            {{ $township->postal_code }}
          </div>
        </div>
        <div class="row">
          <div class="col-xs-2 col-sm-2 col-md-2 ">
            <a class="btn btn-secondary" href="{{ route('townships.index') }}">Back</a>  
          </div>
        </div>
                
      </div>
    </div>
  </div>
</div>
@endsection
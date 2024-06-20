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
                        {{ $consigment->name }}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">Company Name:</strong> <br>
                        {{ $consigment->company_name }}
                    </div>
                
                    <div class="col-md-3 mb-3">
                        <strong class="text-muted">Date:</strong> <br>
                        {{ $consigment->date }}
                    </div>

                    <div class="col-md-3 mb-3">
                      <strong class="text-muted">Signature:</strong> <br>
                      <img src="{{ asset('customer_files/'.$consigment->signature_img) }}" class="w-100" alt="">
                    </div>

                </div>

                <div class="row">
                  <div class="col-md-12">
                    <h4>Extra User</h4>
                  </div>
                </div>
                @foreach ($consigment->consigmentExtraUser as $extra_user)
                <div class="row my-3">
                  <div class="col-md-3">
                    <strong class="text-muted">Name:</strong> <br>
                    {{ $extra_user->extra_name }}
                  </div>
                  <div class="col-md-3">
                    <strong class="text-muted">Company Name:</strong> <br>
                    {{ $extra_user->company_name }}
                  </div>
                  <div class="col-md-3">
                    <strong class="text-muted">Email:</strong> <br>
                    {{ $extra_user->extra_email }}
                  </div>
                  <div class="col-md-3">
                    <strong class="text-muted">Phone:</strong> <br>
                    {{ $extra_user->extra_phone }}
                  </div>
                </div>
                @endforeach
                <div class="row">
                  <div class="col-xs-2 col-sm-2 col-md-2 ">
                    <a class="btn btn-secondary" href="{{ route('consigments.index') }}">Back</a>  
                  </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
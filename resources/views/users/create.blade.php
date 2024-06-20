@extends('layouts.app')


@section('content')
<div class="row py-2">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-header">
                <div class="float-left">
                    <h2>Create New User</h2>
                </div>
                <div class="float-right">
                    
                </div>
            </div>
            <div class="card-body">
               
@if (count($errors) > 0)
<div class="alert alert-danger">
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
     @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
     @endforeach
  </ul>
</div>
@endif



{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
  <div class="col-xs-3 col-sm-3 col-md-3">
      <div class="form-group">
          <strong>Name:</strong>
          {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
      </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3">
      <div class="form-group">
          <strong>Email:</strong>
          {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
      </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3">
      <div class="form-group">
          <strong>Password:</strong>
          {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
      </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3">
      <div class="form-group">
          <strong>Confirm Password:</strong>
          {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
      </div>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6">
      <div class="form-group">
          <strong>Role:</strong>
          {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
      </div>
  </div>
</div>
  <div class="row">
  <div class="col-xs-6 col-sm-6 col-md-6">
    <a class="btn btn-secondary" href="{{ route('users.index') }}"> Back</a>
      <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>
{!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
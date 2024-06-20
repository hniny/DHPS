@extends('layouts.app')


@section('content')
<div class="row py-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2>Create New Role</h2>
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


        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
                
                <div class="row">
                    @foreach($permission as $value)
                    <div class="col-3 mb-3">
                        {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        {{ $value->name }}
                    </div>           
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </div>
        {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
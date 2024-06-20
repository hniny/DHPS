@extends('layouts.app')


@section('content')
<div class="row my-5 ">
  <div class="col-lg-12 ">
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

        <form action="{{ route('products.store') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
          @csrf
          @method('POST')
          <div class="form-row">
            <div class="form-group col-12">
              <label>Name:</label>
		            <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-12">
              <strong>Detail:</strong>
              <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-12">
              <label>Price:</label>
                <input type="text" name="price" class="form-control" placeholder="Price">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-12">
              <strong>Image:</strong>
              <input type="file" name="image" class="form-control"/>
            </div>
          </div>
          </div>
          <div class="form-row">
            <div class="form-group col-12">
              <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
@endsection
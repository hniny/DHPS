@extends('layouts.app')


@section('content')
<div class="row py-2">
    <div class="col-md-12 ">
        <div class="card shadow-sm">
          <div class="card-header">
            <div class="float-left">
              <h4>User Credential</h4>
            </div>
           
          </div>
          <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif
            <table class="table table-bordered">
             <tr>
               <th>No</th>
               <th>Name</th>
               <th>Username</th>
               <th width="280px">Action</th>
             </tr>
             @foreach ($data as $key => $user)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->user_name }}</td>
                <td>
                   <a class="btn btn-info" href="/reset-password/{{$user->id}}">Reset Password</a>
                </td>
              </tr>
             @endforeach
            </table>
            
            
            {!! $data->render() !!}
          </div>
        </div>
    </div>
    
</div>

@endsection
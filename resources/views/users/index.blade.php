@extends('layouts.app')


@section('content')
<div class="row py-2">
    <div class="col-10 ">
        <div class="card shadow-sm">
          <div class="card-header">
            <div class="float-left">
              <h4>User Management</h4>
            </div>
           <div class="float-right">
            <a href="users/create" class="btn btn-primary btn-sm">New Data</a>
            <a href="users" class="btn btn-primary btn-sm">Search Data</a>
           </div>
          </div>
          <div class="card-body">
			  <div class="row">
              <div class="col-md-3 pt-2">
                  <div class="form-group">
                      <select name="name" id="name" class="form-control name" >
                          <option value="">နာမည်အပြည့် အစုံ</option>
                          @foreach ($teamMembers as $key => $item)
                          {{-- @if ($name == $item)
                              <option value="{{$item->users->name}}" selected>{{$item->users->name}}</option>
                              @else --}}
                              <option value="{{$item->name}}">{{$item->name}}</option>
                              {{-- @endif --}}
                          @endforeach
                                 
                      </select>
                  </div>
              </div>
          
              <div class="col-md-3 pt-3">
                <button class="btn btn-primary btn-sm" type="button" id="search">ရှာရန်</button>
              </div>
                   
               </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif
            <table class="table table-bordered">
             <tr>
               <th>No</th>
               <th>Name</th>
               <th>Email</th>
               <th>Roles</th>
               <th width="280px">Action</th>
             </tr>
             @foreach ($data as $key => $user)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                       <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                  @endif
                </td>
                <td>
                   <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                   <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
              </tr>
             @endforeach
            </table>
            
            
            {!! $data->render() !!}
          </div>
        </div>
    </div>
    <div class="col-2">
      <div class="card">
        <div class="card-header">
          Record Info
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Total Records: 
            <span class="badge badge-primary badge-pill">{{$data->count()}}</span>
          </li>
        </ul>
      </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
          $(".name").select2();
        $('#search').on('click', function () {
        var name = $('#name').val();
        window.location.href = '/users?name='+name;
            });
        });
    </script>
@endpush  
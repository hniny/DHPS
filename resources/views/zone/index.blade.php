@extends('layouts.app')
@section('content')
<div class="row py-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-left">
                            <h4>{{ $title }}</h4>
                        </div>
                        <div class="float-right">
                            @can('zone-create')
                            <a class="btn btn-success btn-sm" href="{{ route('zones.create') }}">Create New</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <select name="name" id="name" class="form-control name">
                            <option value="">Zone Name</option>
                            @foreach ($names as $key=>$na)
                            @if ($name ==$na)
                                <option value="{{$na}}" selected>{{$na}}</option>
                            @else
                                <option value="{{$na}}">{{$na}}</option> 
                            @endif
                                                       
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="city" id="city" class="form-control city">
                            <option value="">City</option>
                            @foreach ($cityNames as $key=>$cityName)
                            {{-- @if ($name ==$na)
                                <option value="{{$na}}" selected>{{$na}}</option>
                            @else
                                <option value="{{$na}}">{{$na}}</option> 
                            @endif --}}
                            <option value="{{$cityName}}">{{$cityName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1 pt-2">
                        <button class="btn btn-primary btn-sm" type="button" id="search">ရှာရန်</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        
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
        
        
            <table class="table table-bordered table-sm">
                <tr>
                    <th>No</th>
                    <th>Zone</th>
                    <th>City</th>
                    <th width="280px">Action</th>
                </tr>
                @forelse ($zones as $zone)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $zone->name }}</td>
                    <td>
                      {{ isset($zone->city) ? $zone->city->name : '-' }}
                    </td>
                    <td>
                        <form action="{{ route('zones.destroy',$zone->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('zones.show',$zone->id) }}"><i class="lni lni-eye"></i></a>
                            @can('zone-edit')
                              <a class="btn btn-primary btn-sm" href="{{ route('zones.edit',$zone->id) }}"><i class="lni lni-pencil-alt"></i></a>
                            @endcan
                            @csrf
                            @method('DELETE')
                            @can('zone-delete')
                              <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="lni lni-trash"></i></button>
                            @endcan
                        </form>                         
                </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Data</td>
                    </tr>
                @endforelse
            </table>
            {!! $zones->links() !!}
            </div>
        </div>
    </div>
</div>
  
@endsection

@push('scripts')
<script src="/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".name").select2();
        });
        $(document).ready(function(){
            $(".city").select2();
        });
        $(document).ready(function(){
            $('#search').on('click',function(){
                var name = $('#name').val();
                var city = $('#city').val();
                window.location.href = '/zones?name='+name+'&&city='+city;
            });
        });
    </script>
@endpush
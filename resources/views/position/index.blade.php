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
                            @can('township-create')
                            <a class="btn btn-success btn-sm" href="{{ route('positions.create') }}">Create New</a>
                            @endcan
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-2">
                        <input type="search" name="township" id="township" placeholder="Township" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <select name="city" id="city" class="form-control city">
                            <option value="">City</option>
                            @foreach ($cityNames as $cities)
                        <option value="{{$cities}}">{{$cities}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="zone" id="zone" class="form-control zone">
                            <option value="">Zone</option>
                            @foreach ($zoneNames as $zone)
                        <option value="{{$zone}}">{{$zone}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary btn-sm" type="button" id="search">ရှာရန်</button>
                    </div>
                </div> --}}
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
                    <th>Position</th>
                    <th>Department</th>
                    <th width="280px">Action</th>
                </tr>
                @forelse ($positions as $position)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $position->position_name }}</td>
                    <td>
                      {{ isset($position->department) ? $position->department->dep_name : '-' }}
                    </td>
                    <td>
                        <form action="{{ route('positions.destroy',$position->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('positions.show',$position->id) }}"><i class="fa fa-eye"></i></a>
                            @can('position-edit')
                            <a class="btn btn-primary btn-sm" href="{{ route('positions.edit',$position->id) }}"><i class="fa fa-edit"></i></a>
                            @endcan
                            @csrf
                            @method('DELETE')
                            @can('position-delete')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            @endcan
                        </form>                         
                </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Data</td>
                    </tr>
                @endforelse
            </table>
            {!! $positions->links() !!}
            </div>
        </div>
    </div>
</div>
  
@endsection
@push('scripts')
<script src="/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".city").select2();
        });
        $(document).ready(function(){
            $(".zone").select2();
        });
       
        $(document).ready(function(){
            $('#search').on('click',function(){
                var township = $('#township').val();
                var city = $('#city').val();
                var zone = $('#zone').val();
                window.location.href = '/townships?zone='+zone+'&&city='+city+'&&township='+township;
            });
        });
    </script>
@endpush
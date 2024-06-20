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
                            <a class="btn btn-success btn-sm" href="{{ route('townships.create') }}">Create New</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="row">
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
                    <th>Township</th>
                    <th>City</th>
                    <th>Zone</th>
                    <th>Postal Code</th>
                    <th width="280px">Action</th>
                </tr>
                @forelse ($townships as $township)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $township->name }}</td>
                    <td>
                      {{ isset($township->cities) ? $township->cities->name : '-' }}
                    </td>
                    <td>
                      {{ isset($township->zones) ? $township->zones->name : '-' }}
                    </td>
                    <td>
                      {{ $township->postal_code }}
                    </td>
                    <td>
                        <form action="{{ route('townships.destroy',$township->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('townships.show',$township->id) }}"><i class="fa fa-eye"></i></a>
                            @can('township-edit')
                            <a class="btn btn-primary btn-sm" href="{{ route('townships.edit',$township->id) }}"><i class="fa fa-edit"></i></a>
                            @endcan
                            @csrf
                            @method('DELETE')
                            @can('township-delete')
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
            {!! $townships->links() !!}
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
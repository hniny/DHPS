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
                        @can('city-create')
                        <a class="btn btn-success btn-sm" href="{{ route('cities.create') }}">Create New</a>
                        @endcan
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <select name="city" id="city" class="form-control city">
                            <option value="">City</option>
                            @foreach ($city_names as $key=>$name)
                            @if ($city == $name)
                            <option value="{{$name}}" selected>{{$name}}</option>
                            @else
                            <option value="{{$name}}">{{$name}}</option>
                            @endif

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
                    <th>စဥ်</th>
                    <th>မြို့နာမည်</th>
                    <th width="280px">လုပ်ဆောင်ချက်များ</th>
                </tr>
                @forelse ($cities as $city)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $city->name }}</td>
                    <td>
                        <form action="{{ route('cities.destroy',$city->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('cities.show',$city->id) }}"><i class="fa fa-eye"></i></a>
                            @can('city-edit')
                            <a class="btn btn-primary btn-sm" href="{{ route('cities.edit',$city->id) }}"><i class="fa fa-edit"></i></a>
                            @endcan
                            @csrf
                            @method('DELETE')
                            @can('city-delete')
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
            {!! $cities->links() !!}
            </div>
        </div>
    </div>
</div>
  
@endsection

@push('scripts')
<script src="/js/select2.min.js"></script>
<script >
  $(document).ready(function(){
    $(".city").select2();
  });

  $(document).ready(function () {
    $('#search').on('click', function () {
    var city = $('#city').val();
    window.location.href = '/cities?city='+city;
        });
    });
</script>

@endpush
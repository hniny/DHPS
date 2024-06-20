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
                    @can('product-create')
                    <a class="btn btn-success btn-sm" href="{{ route('products.create') }}"> ပစ္စည်းအသစ်ထည့်ရန်</a>
                    @endcan
                </div>
                </div>

                </div>

                <div class="row">
                  <div class="col-md-2">
                  <input type="search" name="name" id="name" placeholder="ပစ္စည်းနံပါတ်" class="form-control" value="{{$name}}">
                  </div>
                  <div class="col-md-2">
                    <select name="detail" id="detail" class="form-control detail">
                      <option value=""> ပစ္စည်း</option>
                      @foreach ($details as $key => $det)
                      @if ($detail == $det)
                          
                          <option value="{{$det}}" selected>{{$det}}</option>
                      @else
                      <option value="{{$det}}">{{$det}}</option>
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
                <th> ပစ္စည်းနံပါတ်</th>
                <th>ပစ္စည်း</th>
                <th>စျေးနှုန်း</th>
                <th width="280px">လုပ်ဆောင်ချက်များ</th>
              </tr>
                @forelse ($products as $product)
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->detail }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                      <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('products.show',$product->id) }}"><i class="fa fa-eye"></i></a>
                          @can('product-edit')
                            <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}"><i class="fa fa-edit"></i></a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('product-delete')
                          <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        @endcan
                      </form>
                    </td>
                  </tr>
                {{-- <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $township->name }}</td>
                    <td>
                      {{ isset($township->cities) ? $township->cities->name : '-' }}
                    </td>
                    <td>
                      {{ $township->postal_code }}
                    </td>
                    <td>
                        <form action="{{ route('townships.destroy',$township->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('townships.show',$township->id) }}">Show</a>
                            @can('township-edit')
                            <a class="btn btn-primary btn-sm" href="{{ route('townships.edit',$township->id) }}">Edit</a>
                            @endcan
                            @csrf
                            @method('DELETE')
                            @can('township-delete')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                            @endcan
                        </form>                         
                </tr> --}}
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-danger">No Data</td>
                    </tr>
                @endforelse
            </table>
            {!! $products->links() !!}
            </div>
        </div>
    </div>
</div>
  
@endsection
@push('scripts')
<script src="/js/select2.min.js"></script>
<script >
  $(document).ready(function(){
    $(".detail").select2();
  });

  $(document).ready(function () {
    $('#search').on('click', function () {
    var name = $('#name').val();
    var detail = $('#detail').val();
    window.location.href = '/products?name='+name+'&&detail='+detail;
        });
    });
</script>

@endpush
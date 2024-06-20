@extends('layouts.app')


@section('content')
<div class="row py-2">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <div class="float-left">
                    <h2>{{ $title }}</h2>
                </div>
                <div class="float-right">
                    @can('creditReturn-create')
                        <a class="btn btn-success" href="{{ route('credit-returns.create') }}">Create New</a>
                    @endcan
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
        
        
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Invoice No</th>
                    <th>Date of Delivery</th>
                    <th width="280px">Action</th>
                </tr>
                @forelse ($creditReturns as $creditReturn)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('customers.show',$creditReturn->id) }}">Show</a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Data</td>
                    </tr>
                @endforelse
            </table>
            {!! $creditReturns->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
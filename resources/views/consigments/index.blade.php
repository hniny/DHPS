@extends('layouts.app')
@section('content')
<div class="row py-2">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="float-left">
            <h2>Consigments</h2>
          </div>
          <div class="float-right">
            @can('consigment-create')
            <a class="btn btn-success" href="{{ route('consigments.create') }}"> Create New</a>
            @endcan
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
                <th>Date</th>
                <th>Company Name</th>
                <th>Name</th>
                <th width="280px">Action</th>
            </tr>
            @forelse ($consigments as $consigment)
            <tr>
              <td>{{ ++$i }}</td>
              <td>{{ date('M d Y', strtotime($consigment->date)) }}</td>
              <td>{{ $consigment->company_name }}</td>
              <td>{{ $consigment->name }}</td>
              <td>
                <a href="{{ route('consigments.show', $consigment->id) }}" class="btn btn-info btn-sm text-white">Show</a>
              </td>
            </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-danger">Data Empty!</td>
              </tr>
            @endforelse
          </table>
          {!! $consigments->links() !!}
        </div>
      </div>
    </div>
</div>
@endsection
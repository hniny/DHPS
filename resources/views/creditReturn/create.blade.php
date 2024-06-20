@extends('layouts.app')


@section('content')
    <div class="row py-2">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Create Credit Return</h4>
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
                
                    <div id="itemTable" class="itemTable">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{asset('js/validate.js')}}"></script>
<script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.21.1/babel.min.js" charset="utf-8"></script>
<script type="text/babel" src="{{asset('js/itemTable.js')}}"></script>
@endpush
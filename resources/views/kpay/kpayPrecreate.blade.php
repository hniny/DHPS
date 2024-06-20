@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2 class="mt-5"><span class="text-primary">DHPS</span>  Payment Form</h2>
    <div class="row">  
      <div class="col-md-4">
          {{-- {{dd($data)}} --}}
        <form action="#" method="POST">
            @csrf
            @php
                $datas=json_encode($data);             
            @endphp       
            <div class="form-group">
                <label for="">Billers Amount: {{$req_amt}} MMK</label>
                {{-- <input type="text"  value="{{$datas}}" id="req" class='col-md-3'>    --}}
            </div>            
            <div class="form-group">     
              QrCode: {{$qrCode}}  
              prepayId: {{$prepay_id}}<br/>
              <h5 class='mb-3'>Scan QR Code</h5>
              {!! QrCode::size(250)->generate($qrCode); !!}
            </div>  
            
        </form>
        </div>
    </div>
</div>
@endsection

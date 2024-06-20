@extends('layouts.app')
@section('content')
<div class="container mt-4">
 
<h2 class="mt-5"><span class="text-primary">DHPS</span>   KPay Payment Form</h2>
<div class="row">
    <div class="col-md-4">
    <form action="/billPayment" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Billers Amount: 500 MMK</label>
            <input type="hidden" name="trade_type" value="PAY_BY_QRCODE">
        </div>
        <button class="btn btn-sm btn-primary" type="submit">Pay Now</button>
    </form>
    </div>
</div>
</div>
@endsection

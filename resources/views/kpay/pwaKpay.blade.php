@extends('layouts.app')
@section('content')
<div class="container mt-4">
 
<h2 class="mt-5"><span class="text-primary">DHPS</span>   KPay Payment Form</h2>
<div class="row">
    <div class="col-md-4">
    
        <form action="/kbzPayment" method="POST"> 
         @csrf 
        <div class="form-group">
           

        
            <label for="">Billers Amount: 1000 MMK</label>
           
        </div>
     
        {{--<button class="btn btn-sm btn-primary" id="Search" type="submit">Pay Now</button> --}}
    </form>
		 <a href="{{$result}}" referrerpolicy="unsafe-url" class="btn btn-primary"> Pay Now</a>
    </div>
</div>
</div>
@endsection






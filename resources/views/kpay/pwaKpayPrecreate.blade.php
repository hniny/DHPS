@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2 class="mt-5"><span class="text-primary">DHPS</span>  Payment Form</h2>
    <div class="row">  
      <div class="col-md-4">
        
        <form action="/pwabillPayment">
            @csrf 
               
            <div class="form-group">   
                
                      
                <label for="">Billers Amount: 1000 MMK</label>
                {{-- <input type="text"  value="{{$datas}}" id="req" class='col-md-3'>    --}}
            </div>            
            <div class="form-group">  
                <button> Send</button>  
            </div>  
            
        </form>
        </div>
    </div>
</div>
@endsection

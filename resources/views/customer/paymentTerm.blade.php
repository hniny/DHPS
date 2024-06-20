@extends('layouts.app')
@section('content')
<div class="row py-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row py-2">
                    <div class="col-md-6 pt-2">
                        <h4>{{ $title }}</h4>
                    </div>
                   
                </div>
                <div class="row">
                    @can('customer-delete')
                    <div class="col-md-2 pt-2">
                        <div class="form-group">
                            <select  name="team_member" id="team_member" class="form-control assign" >
                                <option value="">သတ်မှတ်အဖွဲ့ဝင်</option>
                                @foreach ($teamMembers as $key=>$teamMember)
                                
                                    <option value="{{$teamMember->id}}"> {{  $teamMember->users->name  }}</option>
               
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endcan
                   
                    

                    <div class="col-md-2 pt-2">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="ကုမ္မဏီနာမည်" name="cname" id="cname">
                    </div>
                    </div>

                    <div class="col-md-1 pt-3">
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
        
            
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="cash-tab" data-toggle="tab" href="#cash" role="tab" aria-controls="cash" aria-selected="true">Cash</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="consignment-tab" data-toggle="tab" href="#consignment" role="tab" aria-controls="consignment" aria-selected="false">Consignment</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="omc-tab" data-toggle="tab" href="#omc" role="tab" aria-controls="omc" aria-selected="false">One Month Credit</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="cash" role="tabpanel" aria-labelledby="cash-tab">
                        @include('customer.cash')
                    </div>
                    {{-- **************************Cash************************************* --}}
                    <div class="tab-pane fade" id="consignment" role="tabpanel" aria-labelledby="consignment-tab">
                        @include('customer.consignment')
                    </div>
                    {{-- **********************Consignment***************************** --}}
                    <div class="tab-pane fade" id="omc" role="tabpanel" aria-labelledby="omc-tab">
                        @include('customer.one_month_credit')
                    </div>
                    {{-- ********************One Month Credit******************** --}}
                  </div>
          
                
                  
            {{-- {!! $customers->links() !!} --}}
            </div>
        </div>
        </div>
    </div>

  
@endsection
@push('scripts')
<script src="/js/select2.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
    
      $(".sel-status").select2();
    
    });

    $(document).ready(function() {
    
    $(".assign").select2();
  
  });

    $(document).ready(function(){
        $('#search').on('click',function(){
            var name = $('#name').val();
            var cname = $('#cname').val();
            var team_member = $('#team_member').val();
            
            if (team_member) {
                window.location.href='/payment_terms?name='+name+'&&cname='+cname+'&&team_member='+team_member;
            } else if (assign) {
                window.location.href='/payment_terms?name='+name+'&&cname='+cname+'&&assign='+assign;
            } else if (team_member) {
                window.location.href='/payment_terms?name='+name+'&&cname='+cname+'&&team_member='+team_member;
            } else {
                window.location.href='/payment_terms?name='+name+'&&cname='+cname;
            }
            
        });
    });
    </script>
@endpush
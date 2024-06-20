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
                    <div class="col-md-6 pt-2">
                        <div class="float-right">
                         @can('customer-create')
                         <a class="btn btn-success btn-sm" href="{{ route('customers.create') }}">Customerအသစ်ထည့်ရန်</a>
                         @endcan
                      </div>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-2 pt-2">
                        <div class="form-group">
                            <select name="name" id="name" class="form-control  sel-status" >
                                <option value="">နာမည်အပြည့် အစုံ</option>
                                @foreach ($names as $key => $item)
                                @if ($name == $item)
                                    <option value="{{$item->user->name}}" selected>{{$item->user->name}}</option>
                                    @else
                                    <option value="{{$item->user->name}}">{{$item->user->name}}</option>
                                    @endif
                            
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @can('customer-delete')
                    <div class="col-md-2 pt-2">
                        <div class="form-group">
                            <select  name="assign" id="assign" class="form-control" >
                                <option value="0">All</option>
                                <option value="1">Not Assign Customer</option>
                                <option value="2">Assign Customer</option>
                            </select>
                        </div>
                    </div>
                    @endcan
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

                    <div class="col-md-1 pt-2">
                      <button class="btn btn-primary " type="button" id="search">ရှာရန်</button>
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
        
                <div class="row ">
                    <div class="col-md-12">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="customer-tab" data-toggle="tab" href="#customer" role="tab" aria-controls="order" aria-selected="true">Customer List</a>
                        </li>
                        @can('user-list')
                        <li class="nav-item">
                            <a class="nav-link" id="report-tab" data-toggle="tab" href="#report" role="tab" aria-controls="warehouse" aria-selected="false">Reports</a>
                          </li> 
                        @endcan
                        
        
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                            <table class="table table-bordered table-sm ">
                                <thead id="responsive-font">
                                <tr>
                                    <th> စဥ်</th>
                                    <th>နာမည်အပြည့် အစုံ</th>
                                    <th>အသုံးပြုသူအမည်</th>
                                    <th>အီးမေးလ်</th>
                                    <th>ရာထူး</th>
                                    <th>ကုမ္မဏီနာမည်</th>
                                    <th>ကုန်သွယ်ရေးအမည်</th>
                                    <th>သတ်မှတ်အဖွဲ့၀◌င် </th>
                                    <th  width="18%">လုပ်ဆောင် ချက်များ</th>
                                </tr>
                            </thead>
                            <tbody id="rp-font">
                                @forelse ($customers as $customer)
               
                                @if ($customer->user->status==0)
                                <tr style="background-color:#38c17269">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ isset($customer->user) ? $customer->user->name : '' }}</td>
                                    <td>{{ isset($customer->user) ? $customer->user->user_name : '' }}</td>
                                    <td>{{ isset($customer->user) ? $customer->user->email : '' }}</td>
                                    <td>{{ isset($customer->position) ? $customer->position : '' }}</td>
                                    <td>{{ isset($customer->componay_name)?$customer->componay_name:'' }}</td>
                                    <td>{{ isset($customer->trading_name)?$customer->trading_name:'' }}</td>
                                    <td>{{ $customer->team_member_name }}</td>
                                    <td>
                                <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">
                                <a class="btn btn-success btn-sm mb-1" id="rp-font" href="{{ route('customers.show',$customer->id) }}"><i class="fa fa-eye"></i></a>
                                    @can('customer-edit')
                    
                                    <a class="btn btn-primary btn-sm  mb-1" id="rp-font" href="{{ route('customers.edit',$customer->id) }}"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @csrf
                                    @method('DELETE')
                                    @can('customer-delete')
                                        <button type="submit" id="rp-font" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        <button type="button" id="rp-font" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#teamMemberModal-{{ $customer->id }}">
                                            Assign
                                        </button> 
                                    @endcan
                    
                                </form>                         
                                </tr>
                                @else
                                <tr >
                                    <td>{{ ++$i }}</td>
                                    <td>{{ isset($customer->user) ? $customer->user->name : '' }}</td>
                                    <td>{{ isset($customer->user) ? $customer->user->user_name : '' }}</td>
                                    <td>{{ isset($customer->user) ? $customer->user->email : '' }}</td>
                                    <td>{{ isset($customer->position) ? $customer->position : '' }}</td>
                                    <td>{{ isset($customer->componay_name)?$customer->componay_name:'' }}</td>
                                    <td>{{ isset($customer->trading_name)?$customer->trading_name:'' }}</td>
                                    <td>{{ $customer->team_member_name }}</td>
                                    <td>
                                <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">
                                    <a class="btn btn-info btn-sm mb-1" id="rp-font" href="{{ route('customers.show',$customer->id) }}"><i class="fa fa-eye"></i></a>
                                    @can('customer-edit')
                    
                                    <a class="btn btn-primary btn-sm  mb-1" id="rp-font" href="{{ route('customers.edit',$customer->id) }}"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @csrf
                                    @method('DELETE')
                                    @can('customer-delete')
                                        <button type="submit" id="rp-font" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        <button type="button" id="rp-font" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#teamMemberModal-{{ $customer->id }}">
                                            Assign
                                        </button> 
                                    @endcan
                    
                                </form>                         
                                </tr>
                                @endif
                
                                @include('customer.teamMemberAssign', ['customer' => $customer, 'team_member_id' => $customer->team_member_id])
                                @empty
                                    <tr>
                                        <th colspan="9" class="text-center text-danger">No Data</th>
                                    </tr>
                                @endforelse
                            </tbody>
                            </table>
        
                        {{ $customers->appends(request()->input())->links() }}
                        </div>
                        {{-- ******************************************************************* --}}
                        <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
                         {{-- <h1>Report</h1> --}}
                            <table class="table table-bordered table-sm ">
                                    <thead id="responsive-font">
                                    <tr>
                                        <th> စဥ်</th> 
                                        <th>နာမည်အပြည့် အစုံ</th>
                                        {{-- <th>အီးမေးလ်</th> --}}
                                        <th>ရာထူး</th>
                                        <th>Customer အမျိုးအစား</th>
                                        <th>ကုမ္မဏီနာမည်</th>
                                        <th colspan="3" >
                                            အစီရင်ခံစာများ</th>
                                    </tr>
                                </thead>
                                <tbody id="rp-font">
                                    @forelse ($customers as $customer)
               
                                    @if ($customer->user->status==0)
                                    <tr style="background-color:#38c17269">
                                        <td>{{ ++$j }}</td>
                                        <td>{{ isset($customer->user) ? $customer->user->name : '' }}</td>
                                        {{-- <td>{{ isset($customer->user) ? $customer->user->email : '' }}</td> --}}
                                        <td>{{ isset($customer->position) ? $customer->position : '' }}</td>
                                        <td>{{ isset($customer->customerType) ? $customer->customerType->name : '' }}</td>
                                        <td>{{ isset($customer->componay_name)?$customer->componay_name:'' }}</td>
                                       
                                        <td>
                                            
                                            <form action="{{ route('customerWeekly') }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="id" value="{{$customer->id}}">
                                                <input type="hidden" name="customer_name" value="{{$customer->user->name }}">
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-download pr-1"></i>Weekly</button>
                            
                                            </form>
                                        </td>
                                        <td>
                                            
                                            <form action="{{ route('customerMonthly') }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="id" value="{{$customer->id}}">
                                                <input type="hidden" name="customer_name" value="{{$customer->user->name }}">
                                                <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-download pr-1"></i>Monthly</button>
                                            </form>
                                        </td>
                                        
                                        <td>
                                            
                                            <form action="{{ route('customerYearly') }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="text" class="year from-control" style="width: 50px" name="year" placeholder="Year"/>

                                                <input type="hidden" name="id" value="{{$customer->id}}">

                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-download pr-1"></i>Yearly</button>
                                
                                            </form>
                                        </td>
                                        
                                                           
                                    </tr>
                                    @else
                                    <tr >
                                         <td>{{ ++$j }}</td>
                                        <td>{{ isset($customer->user) ? $customer->user->name : '' }}</td>
                                        {{-- <td>{{ isset($customer->user) ? $customer->user->email : '' }}</td> --}}
                                        <td>{{ isset($customer->position) ? $customer->position : '' }}</td>
                                        <td>{{ isset($customer->customerType) ? $customer->customerType->name : '' }}</td>
                                        <td>{{ isset($customer->componay_name)?$customer->componay_name:'' }}</td>
                                        <td>
                                            
                                            <form action="{{ route('customerWeekly') }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="id" value="{{$customer->id}}">
                                                <input type="hidden" name="customer_name" value="{{$customer->user->name }}">
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-download pr-1"></i>Weekly</button>
                            
                                            </form>
                                        </td>
                                        <td>
                                            
                                            <form action="{{ route('customerMonthly') }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="id" value="{{$customer->id}}">
                                                <input type="hidden" name="customer_name" value="{{$customer->user->name }}">
                                                <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-download pr-1"></i>Monthly</button>
                                            </form>
                                        </td>
                                        
                                        <td>
                                            
                                            <form action="{{ route('customerYearly') }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="text" class="year from-control" style="width: 50px" name="year" placeholder="Year"/>

                                                <input type="hidden" name="id" value="{{$customer->id}}">

                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-download pr-1"></i>Yearly</button>
                                
                                            </form>
                                        </td>
                                                  
                                    </tr>
                                    @endif
                
                                    @empty
                                        <tr>
                                            <th colspan="9" class="text-center text-danger">No Data</th>
                                        </tr>
                                    @endforelse
                                </tbody>
                                </table>
                            
                            {{ $customers->appends(request()->input())->links() }}
                        </div>
                        {{-- ******************************************************************* --}}
                      </div>
       
                    </div>
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
            var assign = $('#assign').val();
            if (team_member) {
                window.location.href='/customers?name='+name+'&&cname='+cname+'&&team_member='+team_member;
            } else if (assign) {
                window.location.href='/customers?name='+name+'&&cname='+cname+'&&assign='+assign;
            } else if (team_member) {
                window.location.href='/customers?name='+name+'&&cname='+cname+'&&team_member='+team_member;
            } else {
                window.location.href='/customers?name='+name+'&&cname='+cname;
            }
            
        });
        
        $('.year').datepicker({
             minViewMode: 2,
             format: 'yyyy',
        });
       
    });
    </script>
@endpush
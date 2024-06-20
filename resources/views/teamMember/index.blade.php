@extends('layouts.app')

@section('content')
<div class="row py-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                    <div class="float-left">
                        <h2>အဖွဲ့၀င်များ</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="float-right">
                        @can('product-create')
                        <a class="btn btn-success btn-sm" href="{{ route('teammembers.create') }}"> အသစ်ထည့်ရန်</a>
                        @endcan
                    </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-md-3 pt-2">
                        <div class="form-group">
                            <select name="name" id="name" class="form-control name" >
                                <option value="">နာမည်အပြည့်အစုံ</option>
                                @foreach ($teamMembers as $key => $item)
                                @if ($name == $item)
                                    <option value="{{$item->users->name}}" selected>{{$item->users->name}}</option>
                                    @else
                                    <option value="{{$item->users->name}}">{{$item->users->name}}</option>
                                    @endif
                                @endforeach
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 pt-2">
                        <div class="form-group">
                            <select name="department" id="department" class="form-control department" >
                                <option value="">ဌာန</option>
                                @foreach ($departments as $dep)
                                @if ($department == $dep)
                                    <option value="{{$dep->dep_name}}" selected>{{$dep->dep_name}}</option>
                                @else
                                    <option value="{{$dep->dep_name}}">{{$dep->dep_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
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

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="member-tab" data-toggle="tab" href="#member" role="tab" aria-controls="order" aria-selected="true">Member List</a>
                </li>
                @can('user-list')
                <li class="nav-item">
                    <a class="nav-link" id="report-tab" data-toggle="tab" href="#report" role="tab" aria-controls="warehouse" aria-selected="false">Reports</a>
                  </li>
                @endcan
                
                    
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="member" role="tabpanel" aria-labelledby="member-tab">
                    <table class="table table-bordered">
                        <tr>
                            <th>စဥ်</th>
                            <th>နာမည်အပြည့် အစုံ</th>
                            <th>အီးမေးလ်လိပ်စာ</th>
                            <th>အသုံးပြုသူအမည်</th>
                            <th>ဌာန</th>
                            <th>ရာထူး</th>
                            <th width="280px">လုပ်ဆောင်ချက်များ</th>
                        </tr>
                        @forelse ($teamMember as $team)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                            {{ isset($team->users) ? $team->users->name : '~' }}
                          </td>
                            <td>
                            {{ isset($team->users) ? $team->users->email : '~' }}  
                          </td>
                          <td>
                            {{$team->emp_id_no}}
                          </td>
                          <td>
                            {{ isset($team->departments) ? $team->departments->dep_name : '~' }}
                          </td>
                          <td>
                            {{ isset($team->positions) ? $team->positions->position_name : '~' }}
                          </td>
                            <td>
                                <form action="{{ route('teammembers.destroy',$team->id) }}" method="POST">
                                    <a class="btn btn-sm btn-info" href="{{ route('teammembers.show',$team->id) }}"><i class="fa fa-eye"></i></a>
                                    {{-- @can('team-edit') --}}
                                    <a class="btn btn-sm btn-primary" href="{{ route('teammembers.edit',$team->id) }}"><i class="fa fa-edit"></i></a>
                                    {{-- @endcan --}}
                                    {{-- <a href="/{{$team->id}}/downloadTM" class="btn btn-sm btn-success"><i class="fa fa-download pr-1"></i>Monthly Sales</a> --}}

                                    @csrf
                                    @method('DELETE')
                                    {{-- @can('team-delete') --}}
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    {{-- @endcan --}}
                                </form>
                            </td>
                        </tr>
                        @empty
                          <tr>
                            <th colspan="6" class="text-center text-danger">Empty Data!</th>
                          </tr>
                        @endforelse
                    </table>


                    {!! $teamMember->links() !!}
                </div>
                {{-- ******************************************************************* --}}
                
                <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
                    <h1>Report</h1>
                    <table class="table table-bordered">
                       <tr>
                           <th>စဥ်</th>
                           <th>နာမည်အပြည့် အစုံ</th>
                           <th>အီးမေးလ်လိပ်စာ</th>
                           <th>ဌာန</th>
                           <th>ရာထူး</th>
                           <th colspan="3" > အစီရင်ခံစာများ</th>
                       </tr>
                       @forelse ($teamMember as $team)
                       <tr>
                           <td>{{ ++$j }}</td>
                           <td>
                           {{ isset($team->users) ? $team->users->name : '~' }}
                         </td>
                           <td>
                           {{ isset($team->users) ? $team->users->email : '~' }}  
                         </td>
                         <td>
                           {{ isset($team->departments) ? $team->departments->dep_name : '~' }}
                         </td>
                         <td>
                           {{ isset($team->positions) ? $team->positions->position_name : '~' }}
                         </td>
                           <td>
                              
                               <form action="{{ route('teamWeekly') }}" method="POST">
                                   @csrf
                                   @method('POST')
   
                               <input type="hidden" name="id" value="{{$team->id}}">
                               <input type="hidden" name="member_name" value="{{$team->users->name}}">
                                   <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-download pr-1"></i>Weekly</button>
                                   
                               </form>
   
                           </td>
                           <td>
                              
                            <form action="{{ route('teamMonthly') }}" method="POST">
                                @csrf
                                @method('POST')

                            <input type="hidden" name="id" value="{{$team->id}}">
                            <input type="hidden" name="member_name" value="{{$team->users->name}}">
                                <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-download pr-1"></i>Monthly</button>
                                
                            </form>

                        </td>
                        <td>
                              
                            <form action="{{ route('teamYearly') }}" method="POST">
                                @csrf
                                @method('POST')

                                <input type="text" class="year from-control" style="width: 50px" name="year" placeholder="Year"/>

                            <input type="hidden" name="id" value="{{$team->id}}">
                            <input type="hidden" name="member_name" value="{{$team->users->name}}">

                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-download pr-1"></i>Yearly</button>
                                
                            </form>

                        </td>
                       </tr>
                       @empty
                         <tr>
                           <th colspan="6" class="text-center text-danger">Empty Data!</th>
                         </tr>
                       @endforelse
                   </table>
   
   
                   {!! $teamMember->links() !!}  
                   </div>
                
                
                {{-- ******************************************************************* --}}
              </div>



            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".name").select2();
        });
        $(document).ready(function(){
            $(".department").select2();
        });

        $(document).ready(function () {
        $('#search').on('click', function () {
        var name = $('#name').val();
        var department = $('#department').val();
        window.location.href = '/teammembers?name='+name+'&&department='+department;
            });
        });
        $('.year').datepicker({
             minViewMode: 2,
             format: 'yyyy',
        });
    </script>
@endpush    
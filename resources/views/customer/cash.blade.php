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
    @forelse ($cashes as $customer)
   
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
        {{-- @can('customer-edit')
        
        <a class="btn btn-primary btn-sm  mb-1" id="rp-font" href="{{ route('customers.edit',$customer->id) }}"><i class="fa fa-edit"></i></a>
        @endcan
        @csrf
        @method('DELETE')
        @can('customer-delete')
            <button type="submit" id="rp-font" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            <button type="button" id="rp-font" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#teamMemberModal-{{ $customer->id }}">
                Assign
            </button> 
        @endcan --}}
        
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
        {{-- @can('customer-edit')
        
        <a class="btn btn-primary btn-sm  mb-1" id="rp-font" href="{{ route('customers.edit',$customer->id) }}"><i class="fa fa-edit"></i></a>
        @endcan
        @csrf
        @method('DELETE')
        @can('customer-delete')
            <button type="submit" id="rp-font" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            <button type="button" id="rp-font" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#teamMemberModal-{{ $customer->id }}">
                Assign
            </button> 
        @endcan --}}
        
    </form>                         
    </tr>
    @endif
    
    {{-- @include('customer.teamMemberAssign', ['customer' => $customer, 'team_member_id' => $customer->team_member_id]) --}}
    @empty
        <tr>
            <th colspan="9" class="text-center text-danger">No Data</th>
        </tr>
    @endforelse
</tbody>
</table>

{{ $cashes->appends(request()->input())->links() }}
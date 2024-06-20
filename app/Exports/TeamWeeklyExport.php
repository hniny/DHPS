<?php

namespace App\Exports;

use App\OrderRequest;
use App\Customer;
use App\MemberCustomerOrder;
use App\CustomerOrderHasOrderRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeamWeeklyExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $team_id = request()->id;
        // dd($team_id);
        $customer = new Customer;
        $c = Customer::where("team_member_id",$team_id)->select('id')->get();
        // dd(count($c));
        if (count($c)>0) {
            // dd('yes');
            $customer_id = Customer::where("team_member_id",$team_id)->select('id')->get()->toArray();
            // dd($customer_id);
           
            $customer_order_id = MemberCustomerOrder::where('customer_id',$customer_id)->select('customer_order_id')->get()->toArray();
            // dd($customer_order_id);

            $order_request_id = CustomerOrderHasOrderRequest::whereIn('customer_order_id',$customer_order_id)->select('order_request_id')->get()->toArray();
            // dd($order_request_id);
            
            $orders = OrderRequest::whereIn('id',$order_request_id)->select('item_no','quantity')->whereNull("deleted_at")
            ->whereBetween('created_at', array(date("Y-m-d", strtotime("-7 days")), date('Y-m-d')))
            ->get();
            // dd($orders);

            return $orders;
        }else{
            dd("This member doesn't have any customer!");
    }
    }
    public function headings(): array
    {
        return [
            'No',
            'Item No',
            // 'Pack Size',
            // 'Description',
            'Quantity',
            // 'Remark',
            
        ];
    }
}

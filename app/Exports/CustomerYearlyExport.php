<?php

namespace App\Exports;

use App\OrderRequest;
use App\CustomerOrder;
use App\MemberCustomerOrder;
use App\CustomerOrderHasOrderRequest;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerYearlyExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $customer_id = request()->id;
        $year = request()->year;
        //   dd($year);
            $customer_order_id = MemberCustomerOrder::where('customer_id',$customer_id)->select('customer_order_id')->get()->toArray();

            $order_request_id = CustomerOrderHasOrderRequest::whereIn('customer_order_id',$customer_order_id)->select('order_request_id')->get()->toArray();
            // dd($order_request_id);

            $orders = OrderRequest::whereIn('id',$order_request_id)
            ->select('item_no','quantity','created_at')
            ->whereNull("deleted_at")
            ->whereYear('created_at', $year)
            ->get();
      
            // dd($orders);
            return $orders;
        }

        public function headings(): array
        {
            return [
                'Item No',
                // 'Pack Size',
                // 'Description',
                'Quantity',
                'Ordered_at',
            
            ];
        }
    }


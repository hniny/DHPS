<?php

namespace App\Exports;

use App\OrderRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WeeklyReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $from = date('Y-m-d',strtotime(request()->from)); 
        // dd(request()->from && request()->to);      
        $to=date('Y-m-d',strtotime(request()->to));     
        $query = OrderRequest::whereBetween('created_at',[$from,$to])->select('item_no','quantity','description','created_at')->get();
        
        return $query;

        // return OrderRequest::all();
    }
    public function headings(): array
    {
        return [
            'Item No',
            'Description',
            'Quantity',
            'Ordered_at',
            
        ];
    }
}

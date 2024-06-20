<?php

namespace App\Traits;

use DB;

trait Invoice
{
  public function getNextOrderInv()
  {
    $prefix = config('app.order_no_prefix');
    $next = DB::table('invoices')->where('key', 'order_no_next')->first()->value;
    $digit = 4;
    $number = $prefix . str_pad($next, $digit, 0, STR_PAD_LEFT);
    return $number;
  }

  public function increaseNextOrderInv()
  {
    $query = DB::table('invoices')->where('key', 'order_no_next');
    $next = clone($query);
    $next = $next->first()->value;

    if (date('d') == '01') {
      $next = 0;
    }

    $next += 1;
    
    $query->update([
      'value' => $next,
    ]);
  }

//   public function getNextSaleInv()
//   {
//     $prefix = config('cyt.sale_no_prefix');
//     $next = DB::table('invoices')->where('key', 'sale_no_next')->first()->value;
//     $digit = 4;
//     $number = $prefix . str_pad($next, $digit, 0, STR_PAD_LEFT);
//     return $number;
//   }

//   public function increaseNextSaleInv()
//   {
//     $query = DB::table('invoices')->where('key', 'sale_no_next');
//     $next = clone($query);
//     $next = $next->first()->value;

//     if (date('d') == '01') {
//       $next = 0;
//     }

//     $next += 1;
    
//     $query->update([
//       'value' => $next,
//     ]);
//   }
  

//   public function getNextWareHouseInv()
//   {
//     $prefix = config('cyt.wh_no_prefix');
//     $next = DB::table('invoices')->where('key', 'warehouse_no_next')->first()->value;
//     $digit = 4;
//     $number = $prefix . str_pad($next, $digit, 0, STR_PAD_LEFT);
//     return $number;
//   }

//   public function increaseNextWareHouseInv()
//   {
//     $query = DB::table('invoices')->where('key', 'warehouse_no_next');
//     $next = clone($query);
//     $next = $next->first()->value;

//     if (date('d') == '01') {
//       $next = 0;
//     }

//     $next += 1;
    
//     $query->update([
//       'value' => $next,
//     ]);
//   }

}
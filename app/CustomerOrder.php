<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerOrder extends Model
{
    use SoftDeletes;
    protected $fillable = [];
    public function orderRequest()
    {
        return $this->belongsToMany('App\OrderRequest', 'customer_orders_has_order_requests', 'customer_order_id', 'order_request_id');
    }

    public function customer()
    {
      return $this->belongsToMany('App\Customer', 'member_customer_orders', 'customer_order_id', 'customer_id');
    }
}

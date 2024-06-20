<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderRequest extends Model
{
    use SoftDeletes;
    protected $fillable = [];
    public function customerOrder()
    {
        return $this->belongsToMany('App\CustomerOrder', 'customer_orders_has_order_requests', 'order_request_id', 'customer_order_id');
    }
    public function product()
    {
      return $this->belongsTo('App\Product', 'item_no','name');
    }
}

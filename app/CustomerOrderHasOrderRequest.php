<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerOrderHasOrderRequest extends Model
{
    use SoftDeletes;
    
    protected $table = "customer_orders_has_order_requests";
    protected $fillable = [];
}

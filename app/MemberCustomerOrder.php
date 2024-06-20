<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberCustomerOrder extends Model
{
    use SoftDeletes;
    protected $fillable = ['member_id','customer_id','customer_order_id'];
}

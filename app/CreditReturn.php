<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditReturn extends Model
{
    use SoftDeletes;
    protected $fillable = [];
}

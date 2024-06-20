<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnReason extends Model
{
    use SoftDeletes;
    protected $fillable = ['description'];
}

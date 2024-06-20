<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use SoftDeletes;
    protected $fillable = [];

    public function city()
    {
      return $this->belongsTo('App\City', 'city_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TownShip extends Model
{
    use SoftDeletes;
    protected $table = 'townships';
    protected $fillable = ['name', 'city_id', 'zone_id', 'postal_code'];

    public function cities()
    {
      return $this->belongsTo('App\City', 'city_id');
    }
    public function zones()
    {
      return $this->belongsTo('App\Zone', 'zone_id');
    }
}

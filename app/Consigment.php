<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consigment extends Model
{
    use SoftDeletes;
    protected $fillable = [];

    public function consigmentExtraUser()
    {
      return $this->belongsToMany('App\ExtraUser', 'consigemts_has_extra_user', 'consigment_id', 'extra_user_id');
    }

    public function users()
    {
      return $this->belongsTo('App\User', 'user_id');
    }
}

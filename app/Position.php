<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;
    protected $with = ['department'];
    protected $fillable = ['position_name', 'department_id'];

    public function department()
    {
        return $this->belongsTo('App\Department','department_id','id');
    }
}

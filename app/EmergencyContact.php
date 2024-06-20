<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmergencyContact extends Model
{
    use SoftDeletes;
    protected $table = 'emergency_contact';
    protected $fillable = [];
}

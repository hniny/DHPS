<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use SoftDeletes;
    protected $fillable = [];

    public function users()
    {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function departments()
    {
      return $this->belongsTo('App\Department', 'department_id');
    }

    public function positions()
    {
      return $this->belongsTo('App\Position', 'position_id');
    }

    public function emergency_contacts()
    {
      return $this->hasMany('App\EmergencyContact', 'team_member_id');
    }
    public function township()
    {
      return $this->belongsTo('App\TownShip','postal_address');
    }
    public function zone()
    {
      return $this->belongsTo('App\Zone','postal_address');
    }
    
}

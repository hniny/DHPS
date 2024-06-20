<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function customer()
    {
      return $this->hasOne('App\Customer');
    }
    public function teamMember()
    {
      return $this->hasOne('App\TeamMember');
    }
    public function isTeamMember()
    {
        $userType = isset($this->user_type) ? $this->user_type : 0;
        if($userType == config('userTypes.userTypes')['TEAM_MEMBER']) {
           return true;
        }
        return false;
    }
    public function getTeamMemberID()
    {
        return isset($this->teamMember) ? $this->teamMember->id : 0;
    }
    public function getCustomerID()
    {
        return isset($this->customer) ? $this->customer->id : 0;
    }
}

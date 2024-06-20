<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $fillable = [];
    //Attribute Names
    public function getPaymentMethodNameAttribute()
    {
        return config('paymentmethods.paymentmethods')[$this->payment_method];
    }
    public function getApplicantIdImageAttribute()
    {
        return url("/customer_files/".$this->applicant_id);
    }
    public function getCompanyRefIdImageAttribute()
    {
        return url("/customer_files/".$this->company_ref_id);
    }
    public function getTeamMemberNameAttribute()
    {
        return isset($this->teamMember) ? (isset($this->teamMember->users) ? $this->teamMember->users->name : 'Not Assigned Yet') : 'Not Assigned Yet';
    } 

    // Relatioinships
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function position()
    {
        return $this->belongsTo('App\Position');
    }
    public function teamMember()
    {
        return $this->belongsTo('App\TeamMember','team_member_id');
    }
    public function township()
    {
      return $this->belongsTo('App\TownShip','office_address');
    }
    public function customerType()
    {
        return $this->belongsTo('App\CustomerType');
    }
    public function outletType()
    {
        return $this->belongsTo('App\OutletType');
    }
    
}

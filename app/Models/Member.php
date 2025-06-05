<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MemberFee;
use App\Models\Service;
use App\Models\Trainer;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'emergency_contact_number',
        'gender',
        'date_of_birth',
        'address',
        'registration_date',
        'status',
        'medical_conditions',
        'need_trainer',
        'trainer_id',
        'service_ids',
        'plan',
        'fee',
        'profile_photo',
        'status',
    ];

    /* public function getPhoneAttribute($value) {
        return "+91-{$value}";
    } */

    /* public function setPhoneAttribute($value) {
       // $this->attributes['phone'] = preg_replace('/\D/', '', $value);
        //$this->attributes['phone'] =  "91".$value;
    } */

    public function getstatusBadgeClassAttribute() {
        return match ($this->status) {
            'active' => 'badge badge-success',
            'inactive' => 'badge badge-warning', 
            'expired' => 'badge badge-danger',
            default => 'badge badge-primary',
        };
    }

    public function routeNotificationForVonage($notification)
    {        
        return '91'.$this->phone;
    }

    public function memberFees()
    {
        return $this->hasOne(MemberFee::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, 'member_service', 'member_id', 'service_id');
    }
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
    public function getServiceIdsAttribute($value)
    {
        return json_decode($value, true);
    }
    public function setServiceIdsAttribute($value)
    {
        $this->attributes['service_ids'] = json_encode($value);
    }     
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'gender', 'date_of_birth', 'address', 'specialization', 'profile_photo', 'status'];
    protected $casts = [
        'date_of_birth' => 'date',
    ];
    protected $appends = ['full_name'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $attributes = [
        'status' => 'active',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function getProfilePhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
    
    public function setProfilePhotoAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['profile_photo'] = $value;
        } elseif ($value instanceof \Illuminate\Http\UploadedFile) {
            $this->attributes['profile_photo'] = $value->store('trainers', 'public');
        }
    }

    public function getStatusAttribute($value)
    {
        return $value === 'active' ? 'Active' : 'Inactive';
    }
    
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value === 'Active' ? 'active' : 'inactive';
    }
}

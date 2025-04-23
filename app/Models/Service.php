<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'fee'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $casts = [
        'fee' => 'float',
    ];
    protected $appends = ['fee_with_currency'];
    protected $attributes = [
        'fee' => 0.0,
    ];
    public function getFeeWithCurrencyAttribute()
    {
        return env('CURRENCY') . $this->fee . '/month';
    }
    public function setFeeAttribute($value)
    {
        $this->attributes['fee'] = (float) $value;
    }
    public function getFeeAttribute($value)
    {
        return (float) $value;
    }
    public function setFeeWithCurrencyAttribute($value)
    {
        $this->attributes['fee'] = (float) str_replace(env('CURRENCY'), '', $value);
    }
}

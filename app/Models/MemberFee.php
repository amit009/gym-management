<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberFee extends Model
{
    protected $fillable = [
        'member_id',
        'original_amount',
        'discount_amount',
        'final_amount',
        'payment_status',
        //'payment_date',
        //'payment_method',
    ];

    public function getpaymentstatusBadgeClassAttribute() {
        return match ($this->payment_status) {
            'paid' => 'badge badge-success',
            'unpaid' => 'badge badge-danger', 
            'pending' => 'badge badge-warning',
            default => 'badge badge-primary',
        };
    }
}

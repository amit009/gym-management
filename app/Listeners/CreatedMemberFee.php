<?php

namespace App\Listeners;

use App\Events\MemberCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\MemberFee;

class CreatedMemberFee
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MemberCreated $event): void
    {
        $member = $event->member;

        // Example: calculate total amount (dummy logic, replace with real)
        $amount = $member->fee;

        // Insert into member_fee table
        MemberFee::create([
            'member_id' => $member->id,
            'original_amount' => $amount,
            'discount_amount' => 0.00,
            'final_amount' => 0.00,
            'payment_status' => 'unpaid',
        ]);
    }
}

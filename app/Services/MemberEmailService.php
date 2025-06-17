<?php

namespace App\Services;

use App\Models\Member;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class MemberEmailService
{
    /**
     * Create a new class instance.
     */
    public function sendMemberWelcomeEmail(Member $member)
    {        
        Mail::to($member->email)->queue(new WelcomeEmail($member));        
    }
}

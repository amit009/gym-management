<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class PlanServiceCalculator extends Component
{
    public $plan = null;
    public $service = null;
    public $amount = 0;

    // Define available plans and services
    public $plans = [
        'monthly' => 1,
        'quarterly' => 3,
        'half-yearly' => 6,
        'yearly' => 12,
    ];

    public $services = [
        'fitness' => 1200,
        'nutrition' => 800,
        'personal_training' => 1500,
    ];

    public function updated($propertyName)
    {
        Log::debug('Property updated: ' . $propertyName);
        $this->calculateAmount();
    }

    public function calculateAmount()
    {
         
        
        if ($this->plan && $this->service) {
            $this->amount = $this->services[$this->service] * $this->plans[$this->plan];
        } else {
            $this->amount = 0;
        }
    }
    
    public function render()
    {
        return view('livewire.plan-service-calculator');
    }
}

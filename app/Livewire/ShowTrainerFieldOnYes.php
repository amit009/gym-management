<?php

namespace App\Livewire;

use Livewire\Component;

class ShowTrainerFieldOnYes extends Component
{
    /* public $showTrainerOption = 'no';

    public function showOpton()
    {
        $this->showTrainerOption = 'yes';
    } */

    public $showTrainerOption = false;
    
    public function render()
    {
        return view('livewire.show-trainer-field-on-yes');
    }
}

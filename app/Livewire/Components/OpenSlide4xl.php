<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class OpenSlide4xl extends Component
{
    public $openSlide4xl = false;
    public $blade = '';
    public $params = [];

    #[On('openSlide4xl')]
    public function showSlide4xl($blade = null, $params = null)
    {
        $this->openSlide4xl  = true;
        $this->blade = $blade;
        $this->params = $params;
    }
    #[On('closeSlide4xl')]
    public function closeSlide4xl()
    {
        $this->openSlide4xl = false;
    }

    public function render()
    {
        return view('livewire.components.open-slide4xl');
    }
}

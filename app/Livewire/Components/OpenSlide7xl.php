<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class OpenSlide7xl extends Component
{
    public $openSlide7xl = false;
    public $blade = '';
    public $params = [];

    #[On('openSlide7xl')]
    public function showSlide7xl($blade = null, $params = null)
    {
        $this->openSlide7xl  = true;
        $this->blade = $blade;
        $this->params = $params;
    }
    #[On('closeSlide7xl')]
    public function closeSlide7xl()
    {
        $this->openSlide7xl = false;
        $this->blade = '';
    }

    public function render()
    {
        return view('livewire.components.open-slide7xl');
    }
}

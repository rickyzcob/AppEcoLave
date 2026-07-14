<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class OpenSlide6xl extends Component
{
    public $openSlide6xl = false;
    public $blade = '';
    public $params = [];

    #[On('openSlide6xl')]
    public function showSlide6xl($blade = null, $params = null)
    {
        $this->openSlide6xl  = true;
        $this->blade = $blade;
        $this->params = $params;
    }
    #[On('closeSlide6xl')]
    public function closeSlide6xl()
    {
        $this->openSlide6xl = false;
        $this->blade = '';
    }

    public function render()
    {
        return view('livewire.components.open-slide6xl');
    }
}

<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class OpenSlideMd extends Component
{
    public $openSlideMD = false;
    public $blade = '';
    public $params = [];

    #[On('showSlideMD')]
    public function showSlideMD($blade = null, $params = null)
    {
        $this->openSlideMD  = true;
        $this->blade = $blade;
        $this->params = $params;
    }
    #[On('closeSlideMD')]
    public function closeSlideMD()
    {
        $this->openSlideMD = false;
    }

    public function render()
    {
        return view('livewire.components.open-slide-md');
    }
}

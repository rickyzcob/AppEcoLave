<?php

namespace App\Livewire\Components;

use App\Traits\WithModal;
use Livewire\Attributes\On;
use Livewire\Component;

class OpenModal extends Component
{
    use WithModal;

    public $openModal = false;
    public $blade = '';
    public $params = [];
    #[On('showCentralModal')]
    public function showCentralModal($blade = null, $params = null)
    {
        $this->openModal  = true;
        $this->blade = $blade;
        $this->params = $params;
    }

    #[On('hideCentralModal')]
    public function hideCentralModal()
    {
        $this->openModal = false;
    }

    public function render()
    {
        return view('livewire.components.open-modal');
    }
}

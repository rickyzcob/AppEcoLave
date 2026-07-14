<?php

namespace App\Livewire\Site\Partials\Header;

use App\Traits\WithModal;
use Livewire\Component;

class Card extends Component
{
    use WithModal;

    public function render()
    {
        return view('livewire.site.partials.header.card');
    }
}

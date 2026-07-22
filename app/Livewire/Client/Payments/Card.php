<?php

namespace App\Livewire\Client\Payments;

use App\Repositories\Client\NewScheduleRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Card extends Component
{
    public $payment_method;

    public function mount($reference)
    {
        $scheduleRepository = new NewScheduleRepository();
        $this->payment_method = $scheduleRepository->showByReference($reference, Auth::id())['data']['payment_method'];
    }

    public function render()
    {
        return view('livewire.client.payments.card');
    }
}

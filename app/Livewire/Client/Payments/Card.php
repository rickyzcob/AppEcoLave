<?php

namespace App\Livewire\Client\Payments;

use App\Repositories\Client\NewScheduleRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Card extends Component
{
    public $payment_method;
    public $reference;

    public function mount($reference)
    {
        $scheduleRepository = new NewScheduleRepository();
        $scheduleReturnDB = $scheduleRepository->showByReference($reference, Auth::id())['data'];

        if($scheduleReturnDB){
            $this->payment_method = $scheduleReturnDB['payment_method'];
        }
    }

    public function render()
    {
        return view('livewire.client.payments.card');
    }
}

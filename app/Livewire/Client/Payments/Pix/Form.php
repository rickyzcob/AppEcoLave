<?php

namespace App\Livewire\Client\Payments\Pix;

use App\Repositories\Client\NewScheduleRepository;
use App\Services\Asaas\PaymentPixService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{
    public $reference;
    public $qrcode;
    public function mount($reference)
    {
        $this->reference = $reference;
    }

    public function getQrCode()
    {
        $newScheduleRepository = new NewScheduleRepository();
        $newScheduleReturnDB =  $newScheduleRepository->addPixPayment($this->getOrderByReference()['id']);

        if($newScheduleReturnDB['status'] === 'success'){
            $paymentPixService = new PaymentPixService();
            return  $paymentPixService->show($newScheduleReturnDB['data']['payment_id']);
        }

        return $newScheduleReturnDB;
    }
    public function getOrderByReference()
    {
        $newScheduleRepository = new NewScheduleRepository();
        return $newScheduleRepository->showByReference($this->reference, Auth::id())['data'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->order = $this->getOrderByReference();
        $response->qrcode = $this->getQrCode();

        return view('livewire.client.payments.pix.form', ['response' => $response]);
    }
}

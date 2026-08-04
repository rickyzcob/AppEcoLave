<?php

namespace App\Livewire\Client\Payments\Credit;

use App\Repositories\Client\NewScheduleRepository;
use App\Services\Address\AddressService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use Interactions;

    public $state = [];

    public $reference;
    public function mount($reference)
    {
        $this->reference = $reference;
    }

    public function getAddress()
    {
        if(isset($this->state['zip_code'])){
            $addressService  = new AddressService();
            $addressServiceReturn = $addressService->consultCEP($this->state['zip_code']);

            if($addressServiceReturn['code'] == 200) {
                $this->toast()->success('Sucesso', 'Endereço localizado com sucesso !')->send();
                $this->state['street'] = $addressServiceReturn['data']['logradouro'];
                $this->state['neighborhood'] = $addressServiceReturn['data']['bairro'];
                $this->state['city'] = $addressServiceReturn['data']['localidade'];
                $this->state['uf'] = $addressServiceReturn['data']['uf'];
            } else if($addressServiceReturn['code'] == 400) {
                $this->toast()->error($addressServiceReturn['title'], $addressServiceReturn['message'])->send();
            }
        }
    }
    public function save()
    {
        $request = $this->state;

        $newScheduleRepository = new NewScheduleRepository();
        $newScheduleReturnDB = $newScheduleRepository->addCreditCardPayment($this->getOrderByReference()['id'], $request);

        if($newScheduleReturnDB['status'] == 'success') {
            session()->flash('success', 'Pagamento realizado com sucesso!');
            $this->redirectRoute('client.my-schedule');
        } else if ($newScheduleReturnDB['status'] == 'error') {
            $this->dialog()->error('Erro', $newScheduleReturnDB['data']['description'])->send();
        }
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

        return view('livewire.client.payments.credit.form', ['response' => $response]);
    }
}

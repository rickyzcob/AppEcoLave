<?php

namespace App\Livewire\Client\NewSchedule;

use App\Repositories\Admin\Times\TimeRepository;
use App\Repositories\Client\ClientVehiclesRepository;
use App\Repositories\Client\NewScheduleRepository;
use App\Repositories\Site\Services\ServicesRepository;
use App\Services\Address\AddressService;
use App\Traits\WithModal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use WithModal, Interactions;

    public $state = [
        'vehicle_id' => '',
        'date_schedule' => '',
        'type_payment' => '',
        'payment_method' => '',
    ];

    public $order;

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
        if($this->order){
            return $this->update();
        }

        $request = $this->state;

        $newScheduleRepository = new NewScheduleRepository();
        $newScheduleReturnDB = $newScheduleRepository->create(Auth::id(), $request);

        if($newScheduleReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $newScheduleReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->reset('state');
            $this->redirectRoute('client.my-schedule');

        } else if ($newScheduleReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $newScheduleReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function update()
    {
        $request = $this->state;

        $newScheduleRepository = new NewScheduleRepository();
        $newScheduleReturnDB = $newScheduleRepository->update($this->order->id, $request);

        if($newScheduleReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $newScheduleReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getVehicles');
        } else if ($newScheduleReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $newScheduleReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function getSelectVehicles()
    {
        $clientVehiclesRepository = new ClientVehiclesRepository();
        return $clientVehiclesRepository->getSelectVehicles(Auth::id());
    }

    public function getSelectServices()
    {
        $servicesRepository = new ServicesRepository();
        return $servicesRepository->getSelectServices($this->state['vehicle_id']);
    }

    public function getSelectTimes()
    {
        $timeRepository = new TimeRepository();
        return $timeRepository->getAvailableTimes($this->state['date_schedule']);
    }

    public function render()
    {
        $response = new \stdClass();
        $response->vehicles = $this->getSelectVehicles();
        $response->services = $this->getSelectServices();
        $response->times = $this->getSelectTimes();

        return view('livewire.client.new-schedule.form', ['response' => $response]);
    }
}

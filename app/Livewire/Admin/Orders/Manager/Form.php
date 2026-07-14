<?php

namespace App\Livewire\Admin\Orders\Manager;

use App\Repositories\Admin\Orders\OrderRepository;
use App\Repositories\Admin\Services\ServiceRepository;
use App\Repositories\Admin\Services\TypeVehiclesRepository;
use App\Repositories\Washer\Washers\WasherRepository;
use App\Services\Address\AddressService;
use App\Services\Client\ClientService;
use App\Traits\WithModal;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use WithModal, Interactions;

    public array $state = [
        'washer_id' => '',
        'type_id' => '',
        'service_id' => '',
        'user' => [],
    ];

    public $order;
    public $client_id;

    public function mount($id = null)
    {
        $ordersRepository = new OrderRepository();
        $ordersReturnDB = $ordersRepository->show($id)['data'];
        $this->order = $ordersReturnDB;

        if($this->order){
            $this->state = $this->order->toArray();
            $this->state['type_id'] = $ordersReturnDB['service']['type_vehicle_id'];
        }
    }

    public function updatedStateTypeID()
    {
        $this->state['service_id'] = '';
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
                $this->state['country'] = 'Brasil';

            } else if($addressServiceReturn['code'] == 400) {
                $this->toast()->error($addressServiceReturn['title'], $addressServiceReturn['message'])->send();
            }
        }
    }

    public function getClient()
    {
        if(isset($this->state['user']['taxpayer_registration'])){
            $clientService = new ClientService();
            $clientServiceReturn = $clientService->getClient($this->state['user']['taxpayer_registration']);

            if($clientServiceReturn['code'] == 200) {
                $this->toast()->success('Sucesso', $clientServiceReturn['message'])->send();
                $this->client_id = $clientServiceReturn['data']['id'];
                $this->state['user']['name'] = $clientServiceReturn['data']['name'];
                $this->state['user']['email'] = $clientServiceReturn['data']['email'];
                $this->state['user']['phone'] = $clientServiceReturn['data']['phone'];
            } else if($clientServiceReturn['code'] == 400) {
                $this->toast()->error($clientServiceReturn['title'], $clientServiceReturn['message'])->send();
            }
        }
    }

    public function save()
    {
        if($this->order){
            return $this->update();
        }

        $request = $this->state;

        $ordersRepository = new OrderRepository();
        $ordersReturnDB = $ordersRepository->create($request, $this->client_id);

        if($ordersReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $ordersReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getOrders');

        } else if ($ordersReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $ordersReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function update()
    {
        $request = $this->state;

        $ordersRepository = new OrderRepository();
        $ordersReturnDB = $ordersRepository->update($this->order->id, $request);

        if($ordersReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $ordersReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getOrders');
        } else if ($ordersReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $ordersReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function getSelectTypes()
    {
        $typeVehiclesRepository = new TypeVehiclesRepository();
        return $typeVehiclesRepository->getSelectTypeVehicle();

    }

    public function getSelectService()
    {
        $serviceRepository = new ServiceRepository();
        return $serviceRepository->getSelectServices($this->state['type_id']);
    }

    public function getSelectWashers()
    {
        $washersRepository = new WasherRepository();
        return $washersRepository->getSelectWasher();
    }

    public function render()
    {
        $response = new \stdClass();
        $response->types = $this->getSelectTypes();
        $response->services = $this->getSelectService();
        $response->washers = $this->getSelectWashers();

        return view('livewire.admin.orders.manager.form', ['response' => $response]);
    }
}

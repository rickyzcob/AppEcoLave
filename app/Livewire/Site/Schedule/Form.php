<?php

namespace App\Livewire\Site\Schedule;

use App\Models\TypeVehicles;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Register\ClientRepository;
use App\Repositories\Services\ServicesRepository;
use App\Repositories\TypeVehicles\TypeVehiclesRepository;
use App\Services\Address\AddressService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class cForm extends Component
{
    use Interactions;
    public $type_vehicle_id;
    public $service;

    public $state = [];
    public ?float $latitude = null;
    public ?float $longitude = null;

    public function mount()
    {
        $typeVehiclesDB = TypeVehicles::query()->first();
        $this->type_vehicle_id = $typeVehiclesDB['id'];

        if(Auth::user()){
            $this->state['phone'] = Auth::user()->phone;
        }
    }
    public function getType($type_id)
    {
        $this->type_vehicle_id = $type_id;
    }
    public function getTypeVehicles()
    {
        $typeVehiclesRepository = new TypeVehiclesRepository();
        return $typeVehiclesRepository->index()['data'];
    }

    public function getServicesByType()
    {
        $servicesRepository = new ServicesRepository();
        return $servicesRepository->index($this->type_vehicle_id)['data'];
    }

    public function getService($service_id)
    {
        $serviceRepository = new ServicesRepository();
        $this->service = $serviceRepository->show($service_id)['data'];
    }

    public function saveLocation($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        $addressService = new AddressService();
        $addressReturn = $addressService->getAddress($latitude, $longitude);

        $this->toast()->success('Sucesso', 'Endereço localizado com sucesso !')->send();

        $address = $addressReturn['data']['features'][0]['properties'];

        $this->state['city'] = $address['city'];
        $this->state['uf'] = $address['county'];
        $this->state['number'] = $address['housenumber'];
        $this->state['street'] = $address['street'];
        $this->state['neighborhood'] = $address['street'];
        $this->state['zip_code'] = $address['postcode'];
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

        $orderRepository = new OrderRepository();
        $orderReturnDB = $orderRepository->create($request, $this->service);

        if($orderReturnDB['status'] == 'success') {
            return redirect()->route('my-my-orders')->with($orderReturnDB['status'], $orderReturnDB['message']);
        } else if ($orderReturnDB['status'] == 'error') {
            return back()->with($orderReturnDB['status'], $orderReturnDB['message']);
        }
    }


    public function render()
    {
        $response = new \stdClass();
        $response->types = $this->getTypeVehicles();
        $response->services = $this->getServicesByType();

        return view('livewire.site.schedule.form', ['response' => $response]);
    }
}

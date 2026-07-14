<?php

namespace App\Livewire\Admin\Service\Prices;

use App\Repositories\Admin\Services\ServiceRepository;
use App\Traits\WithModal;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use WithModal, Interactions;

    public array $state = [
        'status' => '',
        'price' => '',
    ];

    public $service;
    public $type_id;

    public function mount($type_id = null, $id = null)
    {
        $this->type_id = $type_id;

        $servicesRepository = new ServiceRepository();
        $servicesReturnDB = $servicesRepository->show($id)['data'];
        $this->service = $servicesReturnDB;

        if($this->service){
            $this->state = $this->service->toArray();
        }
    }

    public function save()
    {
        if($this->service){
            return $this->update();
        }

        $request = $this->state;

        $servicesRepository = new ServiceRepository();
        $servicesReturnDB = $servicesRepository->create($this->type_id, $request);

        if($servicesReturnDB['status'] === 'success') {
            $this->toast()->success('Sucesso', $servicesReturnDB['message'])->send();
            $this->closeSlide(2);
            $this->dispatch('getPrices');
        } else if ($servicesReturnDB['status'] === 'error') {
            $this->toast()->error('Erro', $servicesReturnDB['message'])->send();
            $this->closeSlide(2);
        }
    }

    public function update()
    {
        $request = $this->state;

        $servicesRepository = new ServiceRepository();
        $servicesReturnDB = $servicesRepository->update($this->service->id, $request);

        if($servicesReturnDB['status'] === 'success') {
            $this->toast()->success('Sucesso', $servicesReturnDB['message'])->send();
            $this->closeSlide(2);
            $this->dispatch('getPrices');
        } else if ($servicesReturnDB['status'] === 'error') {
            $this->toast()->error('Erro', $servicesReturnDB['message'])->send();
            $this->closeSlide(2);
        }
    }

    public function render()
    {
        return view('livewire.admin.service.prices.form');
    }
}

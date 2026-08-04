<?php

namespace App\Livewire\Admin\Configurations;

use App\Repositories\Admin\Configurations\ConfigurationsRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use Interactions, WithFileUploads;

    public $state = [];
    public $configuration;
    public $logo;

    public function mount($id = null)
    {
        $configurationsRepository = new ConfigurationsRepository();
        $configurationsReturnDB = $configurationsRepository->show()['data'];
        $this->configuration = $configurationsReturnDB;

        if($this->configuration){
            $this->state = $this->configuration->toArray();
        }
    }

    public function updateLogo()
    {
        $this->validate([
            'logo' => 'image|max:1024',
        ]);
    }


    public function update()
    {
        $request = $this->state;

        $configurationsRepository = new ConfigurationsRepository();
        $configurationsReturnDB = $configurationsRepository->update($request, $this->logo);

        if($configurationsReturnDB['status'] === 'success') {
            $this->toast()->success('Sucesso', $configurationsReturnDB['message'])->send();
            $this->dispatch('getServices');
        } else if ($configurationsReturnDB['status'] === 'error') {
            $this->toast()->error('Erro', $configurationsReturnDB['message'])->send();
        }
    }

    public function render()
    {
        return view('livewire.admin.configurations.form');
    }
}

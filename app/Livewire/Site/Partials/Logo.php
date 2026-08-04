<?php

namespace App\Livewire\Site\Partials;

use App\Repositories\Admin\Configurations\ConfigurationsRepository;
use Livewire\Component;

class Logo extends Component
{
    public $configuration;
    public function mount()
    {
        $configurationsRepository = new ConfigurationsRepository();
        $configurationReturnDB =  $configurationsRepository->show()['data'];

        if($configurationReturnDB != null){
              $this->configuration = $configurationReturnDB;
        }
    }
    public function render()
    {
        return view('livewire.site.partials.logo');
    }
}

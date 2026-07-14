<?php

namespace App\Livewire\Admin\Clients;

use App\Repositories\Admin\Clients\ClientRepository;
use App\Traits\WithModal;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Table extends Component
{
    use WithModal, Interactions, WithPagination;

    public $filters;
    public $pageSize = 10;

    public $order = [
        'column' => 'name',
        'order' => 'ASC'
    ];

    #[On('filterTableClients')]
    public function filterTableKeywords($filterData = null)
    {
        $this->resetPage();
        $this->filters = $filterData;
    }
    #[On('clearFilter')]
    public function clearFilter($visible = null)
    {
        $this->resetPage();
        $this->filters = null;
    }

    #[On('getClients')]
    public function getClients()
    {
        $clientsRepository = new ClientRepository();
        return  $clientsRepository->index($this->filters, $this->pageSize, $this->order)['data'];
    }

    public function confirmDelete($id = null ): void
    {
        $clientsRepository = new ClientRepository();
        $clientsReturnDB = $clientsRepository->show($id)['data'];

        $this->dialog()
            ->question('Atenção !', 'Deseja Realmente apagar a cliente ' .$clientsReturnDB['name']. '?')
            ->confirm('Apagar', 'delete', $id)
            ->send();
    }

    public function delete($id = null)
    {
        $clientsRepository = new ClientRepository();
        $clientsReturnDB = $clientsRepository->delete($id);

        if($clientsReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $clientsReturnDB['message'])->send();
        } else if ($clientsReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $clientsReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->clients = $this->getClients();

        return view('livewire.admin.clients.table', ['response' => $response]);
    }
}

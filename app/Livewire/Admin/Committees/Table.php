<?php

namespace App\Livewire\Admin\Committees;

use App\Repositories\Admin\Committees\CommitteesRepository;
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

    #[On('filterTableCommittees')]
    public function filterTableCommittees($filterData = null)
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

    #[On('getCommittees')]
    public function getCommittees()
    {
        $CommitteesRepository = new CommitteesRepository();
        return  $CommitteesRepository->index($this->filters, $this->pageSize, $this->order)['data'];
    }

    public function confirmDelete($id = null ): void
    {
        $CommitteesRepository = new CommitteesRepository();
        $CommitteesReturnDB = $CommitteesRepository->show($id)['data'];

        $this->dialog()
            ->question('Atenção !', 'Deseja Realmente apagar a comissão ' .$CommitteesReturnDB['name']. '?')
            ->confirm('Apagar', 'delete', $id)
            ->send();
    }

    public function delete($id = null)
    {
        $CommitteesRepository = new CommitteesRepository();
        $CommitteesReturnDB = $CommitteesRepository->delete($id);

        if($CommitteesReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $CommitteesReturnDB['message'])->send();
        } else if ($CommitteesReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $CommitteesReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->committees = $this->getCommittees();

        return view('livewire.admin.committees.table', ['response' => $response]);
    }
}

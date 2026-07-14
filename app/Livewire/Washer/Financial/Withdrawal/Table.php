<?php

namespace App\Livewire\Washer\Financial\Withdrawal;

use App\Repositories\Washer\Financial\WithDrawalRepository;
use App\Traits\WithModal;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use TallStackUi\Traits\Interactions;

class Table extends Component
{
    use Interactions, WithModal, WithoutUrlPagination;

    public $filters;
    public $pageSize = 10;

    public $order = [
        'column' => 'created_at',
        'order' => 'desc'
    ];

    #[On('filterTableWithDrawals')]
    public function filterTableWithDrawals($filterData = null)
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

    #[On('getWithDrawals')]
    public function getWithDrawals()
    {
        $withDrawalRepository = new WithDrawalRepository();
        return  $withDrawalRepository->index($this->filters, $this->pageSize, $this->order)['data'];
    }

    public function confirmDelete($id = null ): void
    {
        $withDrawalRepository = new WithDrawalRepository();
        $withDrawalReturnDB = $withDrawalRepository->show($id)['data'];

        $this->dialog()
            ->question('Atenção !', 'Deseja Realmente apagar a solicitação ' .$withDrawalReturnDB['name']. '?')
            ->confirm('Apagar', 'delete', $id)
            ->send();
    }

    public function delete($id = null)
    {
        $withDrawalRepository = new WithDrawalRepository();
        $withDrawalReturnDB = $withDrawalRepository->delete($id);

        if($withDrawalReturnDB['status'] == 'success') {
            $this->dispatch('getBalanceByMonth');
            $this->dispatch('getWithDrawalsByMonth');
            $this->toast()->success('Sucesso', $withDrawalReturnDB['message'])->send();
        } else if ($withDrawalReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $withDrawalReturnDB['message'])->send();
        }
    }

    public function downloadProof($id = null)
    {
        $withDrawalRepository = new \App\Repositories\Admin\Withdrawal\WithdrawalRepository();
        $withDrawalReturnDB = $withDrawalRepository->show($id);

        if($withDrawalReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', 'Download solicitado com sucesso !')->send();
            return response()->download(storage_path("app/public/{$withDrawalReturnDB['data']['file_path']}"));

        } else if ($withDrawalReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $withDrawalReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->withdrawals = $this->getWithDrawals();

        return view('livewire.washer.financial.withdrawal.table', ['response' => $response]);
    }
}

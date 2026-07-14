<?php

namespace App\Livewire\Admin\Withdrawal;

use App\Repositories\Admin\Withdrawal\WithdrawalRepository;
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

    #[On('WithdrawalRepository')]
    public function getWithDrawals()
    {
        $withDrawalRepository = new WithdrawalRepository();
        return  $withDrawalRepository->index($this->filters, $this->pageSize, $this->order)['data'];
    }


    public function downloadProof($id = null)
    {
        $withDrawalRepository = new WithDrawalRepository();
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

        return view('livewire.admin.withdrawal.table', ['response' => $response]);
    }
}

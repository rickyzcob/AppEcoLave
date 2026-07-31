<?php

namespace App\Livewire\Admin\Dashboard\Informations;

use App\Models\Orders;
use App\Models\User;
use Livewire\Component;

class Card extends Component
{
    public function getTotalClients()
    {
        return User::query()->where('scope', 'client')->count();
    }

    public function getTotalProfessionals()
    {
        return User::query()->where('scope', 'washer')->count();
    }

    public function getTotalOrdersToday()
    {
        return Orders::query()->whereDate('created_at', today())->count();
    }

    public function getTotalOrdersStartedToday()
    {
        return Orders::query()->where('status', 'service_started')->whereDate('created_at', today())->count();
    }

    public function getTotalOrdersFinishedToday()
    {
        return Orders::query()->where('status', 'service_finish')->whereDate('created_at', today())->count();
    }

    public function getTotalOrdersInvoicedToday()
    {
        return Orders::query()->where('status', 'service_finish')->whereDate('created_at', today())->sum('price');
    }

    public function getTotalOrdersCanceledToday()
    {
        return Orders::query()->where('status', 'canceled')->whereDate('created_at', today())->count();
    }

    public function render()
    {
        $response = new \stdClass();
        $response->total_clients = $this->getTotalClients();
        $response->total_professionals = $this->getTotalProfessionals();
        $response->total_orders_today = $this->getTotalOrdersToday();
        $response->total_orders_started = $this->getTotalOrdersStartedToday();
        $response->total_orders_finished = $this->getTotalOrdersFinishedToday();
        $response->total_orders_invoiced = $this->getTotalOrdersInvoicedToday();
        $response->total_orders_canceled = $this->getTotalOrdersCanceledToday();

        return view('livewire.admin.dashboard.informations.card', ['response' => $response]);
    }
}

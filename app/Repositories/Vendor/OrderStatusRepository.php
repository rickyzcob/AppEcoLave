<?php

namespace App\Repositories\Vendor;

use App\Models\OrdersStatus;

class OrderStatusRepository
{
    public function createStatusesByOrderId($order_id, $current_status = null)
    {
        $statuses = ['received', 'accepted', 'on_the_way', 'arrived_location', 'service_started', 'service_finish'];

        $description = null;

        foreach ($statuses as $status) {
            if($status == 'received'){
                $description = 'completed';
            } else {
                $description = 'pending';
            }

            OrdersStatus::query()->create([
                'order_id' => $order_id,
                'status' => $status,
                'description' => $description,
            ]);
        }
    }

    public function updateOrderStatuses($order_id, $current_status = null, $next_status = null)
    {
        $orderStatusDB = OrdersStatus::query()->where('order_id', $order_id)->get();

        foreach ($orderStatusDB as $itemStatus) {
            if($itemStatus['status'] == $current_status) {
                $itemStatus->description = 'completed';
                $itemStatus->save();
            }

            if($itemStatus['status'] == $next_status) {
                $itemStatus->description = 'active';
                $itemStatus->save();
            }
        }
    }

    public function resetOrderStatuses($order_id)
    {
        $orderStatusDB = OrdersStatus::query()->where('order_id', $order_id)->get();

        foreach ($orderStatusDB as $itemStatus) {
            if($itemStatus['status'] == 'received'){
                $description = 'completed';
            } else {
                $description = 'pending';
            }

            $itemStatus->description = $description;
            $itemStatus->save();
        }
    }
}

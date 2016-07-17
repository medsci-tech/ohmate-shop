<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Purchase extends Event
{
    use SerializesModels;
    public $customer;
    public $order;

    /**
     * Create a new event instance.
     *
     * @param Customer $customer
     * @param Order    $order
     */
    public function __construct(Customer $customer, Order $order)
    {
        $this->customer = $customer;
        $this->order = $order;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}

<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Customer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PuanConsume extends Event
{
    use SerializesModels;
    /**
     * @var Customer
     */
    public $customer;
    /**
     * @var
     */
    public $beans;

    /**
     * Create a new event instance.
     *
     * @param Customer $customer
     * @param          $beans
     */
    public function __construct(Customer $customer, $beans)
    {
        //
        $this->customer = $customer;
        $this->beans = $beans;
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

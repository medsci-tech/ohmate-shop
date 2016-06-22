<?php

namespace App\Jobs\BeansFeed;

use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteCustomer extends BeansFeed
{
    use InteractsWithQueue, SerializesModels;

    public $beans = 1000;

    public $name = 'invite';

    /**
     * Create a new job instance.
     *
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        parent::__construct($customer);

        if ($level = $customer->level) {
            $this->beans = $level->beans_invite;
        }

        switch ($customer->type_id) {
            case 2:
                $this->name = 'volunteer_invite';break;
            case 3:
                $this->name = 'nurse_invite';break;
            case 4:
                $this->name = 'doctor_invite';break;
            default:
                $this->name = 'invite';break;
        }
    }

    protected function transaction()
    {
        return function () {
            $this->customer->update([
                'beans_total' => $this->customer->beans_total + $this->beans
            ]);
            $this->after = $this->customer->beans_total;
            $this->persist();
        };
    }
}

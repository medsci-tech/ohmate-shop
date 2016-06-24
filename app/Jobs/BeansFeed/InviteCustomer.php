<?php

namespace App\Jobs\BeansFeed;

use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteCustomer extends BeansFeed
{
    public $beans = 1000;

    public $name = 'invite';

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
}

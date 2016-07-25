<?php

namespace App\Jobs\BeansTransaction;

use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PuanConsume extends BeansTransaction
{
    public $name = 'puan_consume';

    public function __construct(Customer $customer, $beans)
    {
        parent::__construct($customer);

        $this->beans =  0 - abs($beans);
    }
}

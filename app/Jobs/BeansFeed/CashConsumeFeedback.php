<?php


namespace App\Jobs\BeansFeed;


use App\Models\Customer;

class CashConsumeFeedback extends BeansFeed
{
    public $beans = 0;

    public $name = 'consume_feedback';

    public function __construct(Customer $customer, $amount)
    {
        parent::__construct($customer);

        $this->beans = $amount * 0.02;
    }
}
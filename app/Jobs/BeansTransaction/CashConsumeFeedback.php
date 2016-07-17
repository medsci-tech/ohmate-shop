<?php


namespace App\Jobs\BeansTransaction;


use App\Models\Customer;

class CashConsumeFeedback extends BeansTransaction
{
    public $beans = 0;

    public $name = 'consume_feedback';

    public function __construct(Customer $customer, $original_cash)
    {
        parent::__construct($customer);

        $this->beans = $original_cash * 100 * 0.02;
    }
}
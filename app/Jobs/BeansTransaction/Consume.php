<?php


namespace App\Jobs\BeansTransaction;


use App\Models\Customer;

class Consume extends BeansTransaction
{
    private $cash_paid_without_post_fee;

    public $name = 'consume';

    public function __construct(Customer $customer, $cash_paid_without_post_fee, $beans_paid)
    {
        parent::__construct($customer);

        $this->beans = 0 - $beans_paid;
        $this->cash_paid_without_post_fee = $cash_paid_without_post_fee;
    }

    public function afterTransaction()
    {
        dispatch(new CashConsumeFeedback($this->customer, $this->cash_paid_without_post_fee));
    }
}
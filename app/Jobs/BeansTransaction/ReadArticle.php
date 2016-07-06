<?php


namespace App\Jobs\BeansTransaction;


use App\Models\Customer;

class ReadArticle extends BeansTransaction
{
    public $beans = 20;

    public $name = 'study';

    public function __construct(Customer $customer)
    {
        parent::__construct($customer);
    }
}
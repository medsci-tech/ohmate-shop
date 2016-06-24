<?php


namespace App\Jobs\BeansFeed;


use App\Models\Customer;

class ReadArticle extends BeansFeed
{
    public $beans = 20;

    public $name = 'study';

    public function __construct(Customer $customer)
    {
        parent::__construct($customer);
    }
}
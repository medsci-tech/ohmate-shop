<?php


namespace App\Werashop\InvitationCounter;


use App\Models\Customer;
use Carbon\Carbon;

class CustomerInvitationCounter
{
    protected $customer;

    /**
     * InvitationCounter constructor.
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function addOneInvitation()
    {
        $key = $this->getKey();

        $this->increaseValueByKey($key);
    }

    /**
     * @return int
     */
    public function getMonthlyCount()
    {
        $key = $this->getKey();
        return \Redis::command('GET', [$key]) ?? 0;
    }

    /**
     * @return string
     */
    protected function getKey()
    {
        $today = Carbon::today();

        $month_prefix = $today->format('Ym');
        $customer_prefix = $this->customer->id;

        return 'ohmate-invitation-count-' . $customer_prefix . '-' . $month_prefix;
    }

    /**
     * @param $key
     */
    protected function increaseValueByKey($key)
    {
        \Redis::command('INCR', [$key]);
    }

}
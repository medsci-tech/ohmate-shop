<?php

namespace App\Listeners;

use App\Events\Register;
use App\Jobs\BeansTransaction\Register as BeansRegister;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GiveFirstRegisterBeanOrNot
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Register  $event
     * @return void
     */
    public function handle(Register $event)
    {
        $customer = $event->customer;
        
        dispatch(new BeansRegister($customer));
    }
}

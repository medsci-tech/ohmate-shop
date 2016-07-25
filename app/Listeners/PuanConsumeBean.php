<?php

namespace App\Listeners;

use App\Events\PuanConsume;
use App\Jobs\BeansTransaction\PuanConsume as PuanConsumeTransaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PuanConsumeBean
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
     * @param  PuanConsume $event
     * @return void
     */
    public function handle(PuanConsume $event)
    {
        dispatch(new PuanConsumeTransaction($event->customer, $event->beans));
    }
}

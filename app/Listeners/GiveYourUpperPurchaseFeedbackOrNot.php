<?php

namespace App\Listeners;

use App\Events\Purchase;
use App\Jobs\BeansTransaction\CashConsumeFeedback;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GiveYourUpperPurchaseFeedbackOrNot
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
     * @param  Purchase  $event
     * @return void
     */
    public function handle(Purchase $event)
    {
        $customer = $event->customer;
        $upper = $customer->getReferrer();
        $order = $event->order;

        if ($upper && in_array($upper->doctorType(), ['A', 'B'])) {
            dispatch(new CashConsumeFeedback($upper, $order->cash_payment));
        }
    }
}

<?php

namespace App\Listeners;

use App\Events\Purchase;
use App\Jobs\BeansTransaction\PatientFirstOrder;
use App\Models\Order;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GiveYourUpperFirstPurchaseBeanOrNot
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

        if ($upper && is_null(
                Order::where('customer_id', $customer->id)
                    ->where('order_status_id', '>=', 2)
                    ->where('id', '!=', $order->id)
                    ->first()
            )) {
            dispatch(new PatientFirstOrder($upper));
        }
    }
}

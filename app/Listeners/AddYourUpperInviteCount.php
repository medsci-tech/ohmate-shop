<?php

namespace App\Listeners;

use App\Events\Register;
use App\Models\InvitationLog;
use App\Werashop\InvitationCounter\CustomerInvitationCounter;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddYourUpperInviteCount
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
        $upper = $customer->getReferrer();

        if ($upper) {
            $this->addInvitationForCustomer($upper);

            InvitationLog::create([
                'upper_id' => $upper->id,
                'lower_id' => $customer->id,
            ]);
        }
    }

    /**
     * @param $upper
     */
    protected function addInvitationForCustomer($upper)
    {
        $counter = new CustomerInvitationCounter($upper);
        $counter->addOneInvitation();
    }
}

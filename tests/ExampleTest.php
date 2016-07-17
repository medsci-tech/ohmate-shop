<?php

use App\Events\Purchase;
use App\Events\Register;
use App\Models\Customer;
use App\Models\Order;
use App\Werashop\InvitationCounter\CustomerInvitationCounter;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
//        $this->visit('/')
//             ->see('Laravel 5');
    }

    public function testRegister()
    {
//        event(new Register(Customer::find(1)));
    }

    public function testPurchase()
    {
//    use App\Events\Purchase;
//    use App\Events\Register;
//    use App\Models\Customer;
//    use App\Models\Order;
//        event(new Purchase(Customer::find(1), Order::find(1)));
    }

    public function testInvite()
    {
        $c = Customer::find(3);
        $counter = new CustomerInvitationCounter(Customer::find(1));
        $before = $counter->getMonthlyCount();
//        $this->assertEquals(0, $before);
        event(new Register($c));
        $after = $counter->getMonthlyCount();
        $this->assertEquals($before + 1, $after);
    }
}

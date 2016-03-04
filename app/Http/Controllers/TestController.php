<?php

namespace App\Http\Controllers;




use App\Models\Customer;
use Carbon\Carbon;

class TestController extends Controller
{
    public function test() {
        $customer = Customer::where('openid', 'oUS_vt3J8ClZx4q1wmx6VBJ1KfwQ')->firstOrFail();
        $end = new \DateTime(Carbon::now()->format('Y-m'));
        $begin = new \DateTime($customer->created_at->format('Y-m'));
        $month =  \Helper::getDatePeriod($begin, $end);
        dd($month);
    }
}
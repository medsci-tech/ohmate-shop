<?php


namespace App\Werashop\Statistics\Enterprise;


use App\Models\Customer;
use Overtrue\Wechat\Shop\Order;

class EnterpriseCalculator
{
    public static function commodity()
    {

    }

    public static function basic()
    {
        return [
            'focus_count' => self::getFocusCount(),
            'register_count' => self::getRegisterCount(),
            'doctor_count' => self::getDoctorCount(),
            'bean_payment_sum' => self::getBeanPaymentSum(),
            'cash_payment_sum' => self::getCashPaymentSum(),
            'order_count' => self::getOrderCount(),
        ];
    }

    protected function getFocusCount()
    {
        return \Cache::remember('enterprise_focus_count', 60, function() {
            return Customer::count();
        });
    }

    protected function getRegisterCount()
    {
        return \Cache::remember('enterprise_register_count', 60, function() {
            return Customer::where('is_registered')->count();
        });
    }

    protected function getDoctorCount()
    {
        return \Cache::remember('enterprise_doctor_count', 60, function() {
            return Customer::where('type_id', 4)->count();
        });
    }

    protected function getBeanPaymentSum()
    {
        return \Cache::remember('enterprise_bean_payment_sum', 60, function() {
            return \App\Models\Order::sum('beans_payment');
        });
    }

    protected function getCashPaymentSum()
    {
        return \Cache::remember('enterprise_cash_payment_sum', 60, function() {
            return \App\Models\Order::sum('cash_payment');
        });
    }

    protected function getOrderCount()
    {
        return \Cache::remember('enterprise_order_count', 60, function() {
            return \App\Models\Order::where('order_status_id', '>', '1')->count();
        });
    }
}
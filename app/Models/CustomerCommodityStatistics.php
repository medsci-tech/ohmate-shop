<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerCommodityStatistics
 *
 */
class CustomerCommodityStatistics extends Model
{
    protected $table = 'customer_commodity_statistics';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public static function getStatisticsByCustomerID($customerID)
    {
        $details = CustomerCommodityStatistics::where('customer_id', $customerID)->get();
        if($details) {
            $details = $details->toArray();
        } else {
            $details = [];
        }
        foreach($details as &$detail) {
            $detail['commodity'] = Commodity::find($detail['commodity_id'])->toArray();
        }
        return $details;
    }
}

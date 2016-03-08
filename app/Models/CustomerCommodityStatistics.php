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

    function getStatisticsByCustomerID($customerID)
    {
        $details = CustomerCommodityStatistics::where('customer_id', $customerID)->get()->toArray();
        foreach($details as &$detail) {
            $detail['commodity'] = Commodity::find($detail['commodity_id'])->toArray();
        }
        return $details;
    }
}

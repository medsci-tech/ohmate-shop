<?php


namespace App\Werashop\Bean;


class Calculator
{
    public function calculate($total_price, $beans)
    {
        if ($total_price > $beans) {
            return [$total_price - $beans, $beans];
        } else {
            return [0, $total_price];
        }
    }

}
<?php


namespace App\Werashop\Cart;


interface Buyable
{
    public function getPrice();

    public function getIdentifer();

    public function getName();

    public function getImageSet();
}
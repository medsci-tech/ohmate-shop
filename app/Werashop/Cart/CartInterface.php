<?php


namespace App\Werashop\Cart;


interface CartInterface
{
    public function addItem(Buyable $item, $amount = 1);

    public function removeItemsById(int $id);

    public function removeItems(array $query);

    public function flush();

    public function getItems();

    public function getTotalCost();

    public function checkout();
}
<?php


namespace App\Werashop\Cart;

use Carbon\Carbon;

class SessionDrivenCart implements CartInterface
{
    /**
     * @var \Illuminate\Support\Collection
     */
    private $_items;
    /**
     * @var float
     */
    private $_totalPrice;
    /**
     * SessionDrivenCart constructor.
     */
    private function __construct()
    {
        $this->_items = collect();
        $this->_totalPrice = 0.00;
    }

    /**
     * @return mixed|static
     */
    public static function getInstance()
    {
        if (!\Session::has('cart')) {
            return new static;
        }

        return \Session::get('cart');
    }

    /**
     * @param Buyable $item
     * @param int $amount
     * @return $this
     */
    public function addItem(Buyable $item, $amount = 1)
    {
        //注意此处$value传入引用, 导致filter()返回值是已被修改过amount的.
        //然而, 由于filter在对数组$this->_items进行foreach操作的时候
        //$key和$value都是传值, 所以$this->_items并不会被改变.
        //可以通过修改filter函数来达到目的, 但这样并不是很elegant的做法
        //这里通过获取到$key值,来做到在原数组中手动去修改.
        $has_same_items = $this->_items->contains(function ($key, $value) use ($item, $amount) {
            if($value['buyable']['id'] == $item->getIdentifer()) {
                $this->addExistsIntoItems($key, $amount, $item);
                return true;
            }
        });

        if (!$has_same_items) {
            $this->addNewIntoItems($item, $amount);
        }

        return $this;
    }

    /**
     * @param int $id
     * @return array
     */
    public function removeItemsById(int $id)
    {
        return $this->removeItems(['id' => $id]);
    }

    /**
     * @param array $query
     * @return array
     */
    public function removeItems(array $query)
    {
        $result = [];
        $items = $this->_items->reject(function ($value) use ($query, $result) {
            foreach ($query as $k => $v) {
                if (isset($value['buyable'][$k]) and $value['buyable'][$k] != $v) {
                    return false;
                }
            }
            $this->_totalPrice -= $value['buyable']['price'] * $value['amount'];
            $result []= $value;
            return true;
        });

        $this->_items = $items;
        return $result;
    }

    /**
     * @return $this
     */
    public function flush()
    {
        $this->_items = collect();
        $this->_totalPrice = 0.00;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getItems()
    {
        return $this->_items;
    }

    /**
     * @return float
     */
    public function getTotalCost()
    {
        return $this->_totalPrice;
    }

    /**
     * @return string
     */
    public function checkout()
    {
        return "check me out";
        // TODO: Implement checkout() method.
    }

    /**
     * @param Buyable $item
     * @param $amount
     */
    protected function addNewIntoItems(Buyable $item, $amount)
    {
        $this->_items->push([
            'add_time' => Carbon::now()->getTimestamp(),
            'amount' => $amount,
            'buyable' => [
                'id' => $item->getIdentifer(),
                'name' => $item->getName(),
                'price' => $item->getPrice(),
                'image_set' => $item->getImageSet()
            ]
        ]);

        $this->_totalPrice += $item->getPrice() * $amount;
    }

    /**
     * @param $key
     * @param $amount
     * @param $item
     */
    protected function addExistsIntoItems($key, $amount, $item)
    {
        $temp = $this->_items->get($key);
        $temp['amount'] += $amount;
        $this->_items->forget($key);
        $this->_items->push($temp);
        $this->_totalPrice += $amount * $item->getPrice();
    }
}
<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Customer;
use App\Models\YikangQuestionnaire;

class YikangQustionnaireRequest extends Request
{
    /** @var Customer $customer */
    protected $customer;

    public function __construct()
    {
        parent::__construct();
        $this->customer = \Helper::getCustomerOrFail();
//        $this->customer = Customer::find(1);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }

    public function persistWithCustomer(Customer $customer)
    {
        $result = $this->processArrayValue();

        return $customer->yikangQuestionnaire()->save(
            //new YikangQuestionnaire(array_only($result, ['q1', 'q2', 'q3', 'q3a', 'q3b', 'q3c' , 'q3d', 'q3d2', 'q3e', 'q4', 'q1b']))
            new YikangQuestionnaire($result)
        );
    }

    /**
     * @return mixed
     */
    public function persist()
    {
        $result = $this->processArrayValue();

        return $this->customer->yikangQuestionnaire()->save(
            //new YikangQuestionnaire(array_only($result, ['q1', 'q2', 'q3', 'q3a', 'q3b', 'q3c' , 'q3d', 'q3d2', 'q3e', 'q4', 'q1b']))
            new YikangQuestionnaire($result)
        );
    }

    /**
     * @return array
     */
    protected function processArrayValue()
    {
        $result = [];
        foreach ($this->all() as $value => $item) {
            if (is_array($item)) {
                $item = join(",", $item);
            }
            $result[$value] = $item;
        }
        return $result;
    }
}

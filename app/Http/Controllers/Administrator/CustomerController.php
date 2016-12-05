<?php

namespace App\Http\Controllers\Administrator;
use App\Models\BeanLog;
use App\Models\Customer;
use App\Models\CustomerBean;
use App\Models\CustomerInformation;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('backend.customer.index');
    }
    /**
     * 修改用户迈豆数
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function searchBean(Request $request)
    {
        $key = $request->input('key', null);
        $customers = BeanLog::select();

        if ($key) {
            $key_phrase = '%' . $key . '%';
            $customers = $customers->where('phone', 'like', $key_phrase);
        }
        return response()->json([
            'success' => true,
            'data'    => [
                'customers' => $customers
                    ->orderBy('id', 'desc')
                    ->paginate(1, ['*'])
            ]
        ]);

    }
    /**
     * 修改迈豆数
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function saveBean(Request $request)
    {
        $phone = $request->input('phone', null);
        $beans = $request->input('beans', null);
        $remark = $request->input('remark', null);
        /* 同步用户通行证验证合法性 */
        $post_data = array("phone" => $phone,'beans'=>$beans);
        $res = \Helper::tocurl(env('API_URL'). '/modify-bean', $post_data,1);
        if (isset($res['phone'])) {
            return response()->json([
                'success' => false,
                'data'    => [
                    'customer' => null,
                    'message' => '电话号码不存在!'
                ]
            ]);
        }
        $model= new BeanLog();
        $model->phone = $phone;
        $model->beans = $beans;
        $model->remark = $remark;
        $model->opt = \Auth::user()->name;
        $model->save();
        return response()->json([
            'success' => true,
            'data'    => [
                'customer' => BeanLog::orderBy('id', 'desc')->get()
            ]
        ]);

    }


    public function customerList()
    {
        return response()->json([
            'success' => true,
            'data'    => [
                'customers' => Customer::where('phone', '!=', 'NULL')
                    ->where('is_registered', 1)
                    ->with(['statistics', 'information', 'type'])
                    ->orderBy('id', 'desc')
                    ->paginate(20, ['*'])
            ]
        ]);
    }

    public function search(Request $request)
    {
        $type_id = $request->input('type_id', null);
        $key = $request->input('key', null);

        $customers = Customer::select();

        if ($type_id) {
            $customers = $customers->where('type_id', $type_id);
        }

        if ($key) {
            $key_phrase = '%' . $key . '%';
            $customers = $customers->where('phone', 'like', $key_phrase);
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'customers' => $customers
                    ->where('is_registered', 1)
                    ->with(['statistics', 'information', 'type'])
                    ->orderBy('id', 'desc')
                    ->paginate(20, ['*'])
            ]
        ]);
    }

    public function searchForTypeA(Request $request)
    {
        $key = $request->input('key', null);
        $value = $request->input('value', null);


        if ($key && $value != null) {
            $customers = Customer::whereHas('information', function($query) use($key, $value) {
                $query->where('type', 'A')->where($key, 'like', '%' . $value . '%');
            });
        } else {
            $customers = Customer::whereHas('information', function ($query) {
                $query->where('type', 'A');
            });
        }

        $customers = $customers->with('information');

        return response()->json([
            'success' => true,
            'data'    => [
                'customers' => $customers
                    // ->makeVisible('focus_count')
                    ->orderBy('id', 'desc')
                    ->paginate(20)
            ]
        ]);
    }

    public function beans($id)
    {
        $customer = Customer::findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => [
                'beans' => CustomerBean::where('customer_id', $customer->id)
                    ->with('rate')
                    ->orderBy('id', 'desc')->paginate(5)
            ]
        ]);
    }

    public function friends($id)
    {
        $customer = Customer::findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => [
                'friends' => Customer::where('referred_id', $customer->id)
                    ->where('is_registered', 1)
                    ->select(['id', 'phone', 'created_at'])
                    ->orderBy('id', 'desc')->paginate(5)
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customerInformation = CustomerInformation::where('customer_id', $customer->id)->first();

        if (!$customerInformation) {
            $customerInformation = CustomerInformation::create([
                'customer_id' => $customer->id
            ]);
        }

        $phone = $customerInformation->phone;
        $inputPhone = $request->input('phone');

        if ($inputPhone && $inputPhone != $phone) {
            $customer = Customer::where('phone', $inputPhone)->first();
            if ($customer) {
                $customerInformation->update([
                    'customer_id' => $customer->id,
                ]);
            } else {
                $customerInformation->update([
                    'customer_id' => null,
                ]);
            }
        }

        $customerInformation->update([
            'name'           => $request->input('name'),
            'hospital'       => $request->input('hospital'),
            'province'       => $request->input('province'),
            'city'           => $request->input('city'),
            'district'       => $request->input('district'),
            'department'     => $request->input('department'),
            'remark'         => $request->input('remark'),
            'type'           => $request->input('type'),
            'referred_name'  => $request->input('referred_name'),
            'referred_phone' => $request->input('referred_phone'),
            'region'         => $request->input('region'),
            'region_level'   => $request->input('region_level'),
            'responsible'    => $request->input('responsible'),
            'hospital_level' => $request->input('hospital_level'),
            'phone'          => $request->input('phone'),
        ]);

        if ($request->has('beans_total') && $customer) {
            $customer->update([
                'beans_total' => $request->input('beans_total'),
            ]);
        }

        if ($request->has('type_id') && $customer) {
            $customer->update([
                'type_id' => $request->input('type_id')
            ]);
        }

        if ($customer) {
            return response()->json([
                'success' => true,
                'data'    => [
                    'customer' => $customer->with('information')
                ]
            ]);
        } else {
            return response()->json([
                'success' => true,
                'data'    => [
                    'customer' => null
                ]
            ]);
        }
    }

    public function store(Request $request)
    {
        $customerInformation = CustomerInformation::create([
            'name'           => $request->input('name'),
            'hospital'       => $request->input('hospital'),
            'province'       => $request->input('province'),
            'city'           => $request->input('city'),
            'district'       => $request->input('district'),
            'department'     => $request->input('department'),
            'remark'         => $request->input('remark'),
            'type'           => $request->input('type'),
            'referred_name'  => $request->input('referred_name'),
            'referred_phone' => $request->input('referred_phone'),
            'region'         => $request->input('region'),
            'region_level'   => $request->input('region_level'),
            'responsible'    => $request->input('responsible'),
            'hospital_level' => $request->input('hospital_level'),
            'phone'          => $request->input('phone'),
        ]);
        $inputPhone = $request->input('phone');

        if ($inputPhone) {
            $customer = Customer::where('phone', $inputPhone)->first();
            if ($customer) {
                $customerInformation->update([
                    'customer_id' => $customer->id,
                ]);
            } else {
                $customerInformation->update([
                    'customer_id' => null,
                ]);
            }
        }

        if ($request->has('beans_total') && $customer) {
            $customer->update([
                'beans_total' => $request->input('beans_total'),
            ]);
        }

        if ($request->has('type_id') && $customer) {
            $customer->update([
                'type_id' => $request->input('type_id')
            ]);
        }

        if ($customer) {
            return response()->json([
                'success' => true,
                'data'    => [
                    'customer' => $customer->with('information')
                ]
            ]);
        } else {
            return response()->json([
                'success' => true,
                'data'    => [
                    'customer' => null
                ]
            ]);
        }
    }

    public function minusBeans(Request $request)
    {
        $customer = Customer::find($request->input('customer_id'));
        $amount = $request->input('amount');

        return $customer->minusBeansByHand($amount);
    }

    public function lowerList(Request $request)
    {
        $customer_id = $request->input('customer_id');
        $customer = Customer::findOrFail($customer_id);

        // $lower_list = Customer::with(['yikangQuestionnaire', 'orders'])->where('referrer_id', $customer->id);
        // $lower_list = \DB::table('customers')
        //     ->leftJoin('yikang_questionnaires', 'customers.id', '=', 'yikang_questionnaires.customer_id')
        //     ->leftJoin('orders', 'customers.id', '=', 'orders.customer_id')
        //     ->where('customers.referrer_id', $customer->id)
        //     ->select('customers.*', 'orders.*');

        $lower_list = \DB::select(\DB::raw('
    SELECT tmp1.*, tmp2.* FROM
    (
        SELECT 
            lowers.*, subscribe_questionnaires.id as questionnaire_id, subscribe_questionnaires.q1, subscribe_questionnaires.q1b, subscribe_questionnaires.q2, subscribe_questionnaires.q2b, subscribe_questionnaires.q3, subscribe_questionnaires.q3a, subscribe_questionnaires.q3b, subscribe_questionnaires.q3c, subscribe_questionnaires.q3d, subscribe_questionnaires.q3d2, subscribe_questionnaires.q3e, subscribe_questionnaires.q4
        FROM 
            (SELECT * FROM customers WHERE referrer_id = ' . $customer->id . ') lowers 
        LEFT JOIN
            subscribe_questionnaires
        ON lowers.id = subscribe_questionnaires.customer_id
    ) tmp1
    LEFT JOIN 
    (   
        SELECT 
            customer_id, sum(cash_payment) as lower_cash_payment_sum, sum(beans_payment) as lower_beans_payment_sum
        FROM
            orders
        WHERE
            customer_id IN (SELECT id FROM customers WHERE referrer_id = ' . $customer->id . ')
        GROUP BY
            customer_id
    ) tmp2
    ON 
        tmp1.id = tmp2.customer_id
        '));

        return response()->json([
            'success' => true,
            'data'    => [
                'lower_list' => $lower_list
            ]
        ]);
    }

}

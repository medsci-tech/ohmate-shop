<?php

namespace App\Http\Controllers\Questionnaire;

use App\Models\Customer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class YikangQuestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.wechat');
//        $this->middleware('auth.access');
    }

    public function index()
    {
        /** @var Customer $customer */
        $customer = \Helper::getCustomerOrFail();
        $q = $customer->yikangQuestionnaire()->first();
        if ($q) {
            if ($q->q1 == '口服药等其他治疗方式' || $q->q2 == '已停用') {
                return view('questionnaire.finish2')->with(['result' => 1]);
            }
            return view('questionnaire.finish2')->with(['result' => 2]);
        }
        return view('questionnaire.questionnaire2');
    }

    public function result(Requests\YikangQustionnaireRequest $request)
    {
        $request->persist();
        /** @var Customer $customer */
        $customer = \Helper::getCustomerOrFail();
        $q = $customer->yikangQuestionnaire()->first();

        if ($q->q1 == '口服药等其他治疗方式' || $q->q2 == '已停用') {
            $result = 1;
        } else {
            $result = 2;
        }

        return view('questionnaire.finish2')->with(['result' => $result]);
    }
}

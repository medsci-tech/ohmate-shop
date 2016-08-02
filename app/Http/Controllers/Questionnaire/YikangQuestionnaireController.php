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
        if ($customer->yikangQuestionnaire()->count() > 0) {
            return view('questionnaire.finish');
        }
        return view('questionnaire.questionnaire');
    }

    public function result(Requests\YikangQustionnaireRequest $request)
    {
        $request->persist();
        return view('questionnaire.finish');
    }
}

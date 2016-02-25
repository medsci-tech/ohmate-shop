<?php

namespace App\Http\Controllers\Education;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Constants\AppConstant;
use App\Models\Customer;
use App\Models\Article;

class EductionController extends Controller
{
    function __construct()
    {
//        $this->middleware('auth.wechat');
    }

    public function injections()
    {
        return view('education.injection');
    }

    public function injectionView(Request $request)
    {
        $customer = \Helper::getCustomer();
        \BeanRecharger::scanVideo($customer->id);
    }

    public function articleList(Request $request)
    {
        $articles = Article::where('top', true)
            ->orderBy('id','desc')
            ->get();

        return view('education.article', ['articles' => $articles]);
    }

    public function articleView(Request $request)
    {
        $articles = Article::where('id', $request->input('id'))->first();
        if($articles) {
            $articles->count += 1;
            $articles->save();
        }
    }

    public function articleRead(Request $request)
    {
        \Log::info('EductionController:articleRead');
        $articles = Article::where('id', $request->input('id'))->first();
        $customer = \Helper::getCustomer();
        if ($customer != null && $articles != null) {
            \Log::info('EductionController:articleRead:step');
            $ret = \BeanRecharger::scanArticle($customer->id);
        }
    }

} /*class*/

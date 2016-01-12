<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EductionController extends Controller
{
    //
//    function __construct()
//    {
//        // TODO: Implement __construct() method.
//        $this->middleware('auth.wechat');
//        $this->middleware('auth.access');
//    }

    public function essay()
    {
        return 'essay';
    }

    public function video()
    {
        return 'video';
    }

} /*class*/

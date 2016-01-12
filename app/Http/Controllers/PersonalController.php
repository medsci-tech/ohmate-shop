<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;




class PersonalController extends Controller
{
    //
    function __construct()
    {
        // TODO: Implement __construct() method.
        $this->middleware('auth.wechat');
        $this->middleware('auth.access');
    }

    public function information()
    {
        return 'information';
    }

    public function beans()
    {
        return 'beans';
    }

    public function advertisement()
    {
        return 'advertisement';
    }

} /*class*/

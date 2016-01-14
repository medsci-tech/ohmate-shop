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

    public function addresses()
    {
        return 'addresses';
    }

    public function orders()
    {
        return 'orders';
    }

    public function friend()
    {
        return 'friend';
    }

} /*class*/

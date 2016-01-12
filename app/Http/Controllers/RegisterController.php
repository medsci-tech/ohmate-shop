<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.wechat');
    }

    public function create()
    {
        return 'create';
    }

    public function store()
    {
        return 'store';
    }

} /*class*/

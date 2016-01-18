<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EductionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.wechat');
        $this->middleware('beans.ceiling');
    }

    public function essay()
    {
        return 'essay';
    }

    public function injection()
    {
        return 'injection';
    }

    public function game()
    {
        return 'game';
    }

} /*class*/

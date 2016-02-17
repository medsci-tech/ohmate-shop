<?php

namespace App\Http\Controllers\Github;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GithubController extends Controller
{
    public function onEvent() {
        echo exec('git pull origin master');
    }
}

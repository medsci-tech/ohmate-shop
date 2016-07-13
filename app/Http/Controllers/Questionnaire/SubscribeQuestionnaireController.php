<?php

namespace App\Http\Controllers\Questionnaire;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubscribeQuestionnaireController extends Controller
{
    public function index()
    {
        return view('questionnaire.questionnaire');
    }
}

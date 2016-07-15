<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests\DoctorInformationExcelRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DoctorExcelController extends Controller
{
    public function index()
    {
        return view('admin.doctor-excel');
    }

    public function post(DoctorInformationExcelRequest $request)
    {
        $request->persist();   
    }
}

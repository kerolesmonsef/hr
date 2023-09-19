<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MangerController extends Controller
{
    public function getSubEmployees()
    {
        $employees = auth()->user()->employee->subEmployees()->get(['name','id']);
        return $this->success($employees);
    }

}

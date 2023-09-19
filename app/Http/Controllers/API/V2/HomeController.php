<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponser;

    public function index(){

        dd( auth()->user()->employee->tasks );
//        $tasks = Task::
    }


}

<?php

namespace App\Http\Controllers\API\V1\Landpage;
use App\Http\Controllers\Controller;
use App\Services\PlanPageService;
use App\Traits\ApiResponser;

class PlanPage extends Controller
{
    use ApiResponser;
    protected PlanPageService  $planpageservice;
    public function __construct(PlanPageService $planpageservice)
    {
        $this->planpageservice = $planpageservice;
    }
    public function index(){
        return $this->planpageservice->getData();
    }
}

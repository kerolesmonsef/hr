<?php

namespace App\Http\Controllers\API\V1\Landpage;
use App\Http\Controllers\Controller;
use App\Services\TermPageService;
use App\Traits\ApiResponser;

class TermPage extends Controller
{
    use ApiResponser;
    protected TermPageService  $termpageservice;
    public function __construct(TermPageService $termpageservice)
    {
        $this->termpageservice = $termpageservice;
    }
    public function index(){
        return $this->termpageservice->getData();
    }
}

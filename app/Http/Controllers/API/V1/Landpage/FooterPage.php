<?php

namespace App\Http\Controllers\API\V1\Landpage;

use App\Http\Controllers\Controller;
use App\Services\FooterPageService;
use App\Traits\ApiResponser;

class FooterPage extends Controller
{
    //
    use ApiResponser;
    protected FooterPageService $footerpageservice ;
    public function __construct(FooterPageService $footerpageservice)
    {
        $this->footerpageservice = $footerpageservice;
    }
    public function index(){
        return $this->footerpageservice->getData();
    }
}

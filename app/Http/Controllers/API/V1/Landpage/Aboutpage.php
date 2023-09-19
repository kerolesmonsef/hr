<?php

namespace App\Http\Controllers\API\V1\Landpage;

use App\Http\Controllers\Controller;
use App\Services\AboutPageService;

class Aboutpage extends Controller
{
    //
    protected AboutPageService $aboutPageService ;
    public function __construct(AboutPageService $aboutPageService)
    {
        $this->aboutPageService = $aboutPageService;
    }
    public function index(){
        return $this->aboutPageService->getData();
    }
}

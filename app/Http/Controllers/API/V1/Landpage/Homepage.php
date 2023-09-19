<?php

namespace App\Http\Controllers\API\V1\Landpage;

use App\Http\Controllers\Controller;
use App\Services\HomePageService;
use App\Traits\ApiResponser;


class Homepage extends Controller
{
    //
    use ApiResponser;
    protected HomePageService $homepageservice;

    public function __construct(HomePageService $homePageService)
    {
        $this->homepageservice = $homePageService;
    }
    public function index(){
        return $this->homepageservice->getData();
    }
}

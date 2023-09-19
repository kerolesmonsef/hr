<?php

namespace App\Http\Controllers\API\V1\Landpage;
use App\Http\Controllers\Controller;
use App\Services\PrivacyPageService;
use App\Traits\ApiResponser;

class PrivacyPage extends Controller
{
    use ApiResponser;
    protected PrivacyPageService  $privacypageservice;
    public function __construct(PrivacyPageService $privacypageservice)
    {
        $this->privacypageservice = $privacypageservice;
    }
    public function index(){
        return $this->privacypageservice->getData();
    }
}

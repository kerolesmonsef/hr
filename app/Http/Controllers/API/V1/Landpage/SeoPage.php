<?php

namespace App\Http\Controllers\API\V1\Landpage;

use App\Http\Controllers\Controller;
use App\Models\Landsection;
use App\Services\HomePageService;
use App\Traits\ApiResponser;


class SeoPage extends Controller
{
    //
    use ApiResponser;
    protected HomePageService $homepageservice;

    public function __construct(HomePageService $homePageService)
    {
        $this->homepageservice = $homePageService;
    }
    public function index(){
        $sections = Landsection::whereIn('key' , ['homeSection','aboutSection','demoSection','contactSection'])->get();
        $homeSection = $sections->where('key' , 'homeSection')->firstorfail();
        $aboutSection = $sections->where('key' , 'aboutSection')->firstorfail();
        $demoSection = $sections->where('key' , 'demoSection')->firstorfail();
        $contactSection = $sections->where('key' , 'contactSection')->firstorfail();
        return $this->success([
            'homeSeo' => [
                'metaTitle' => $homeSection->metaTitle,
                'metaDescription' => $homeSection->metaDescription,
                'metaKey' => $homeSection->metaKey,
                'metaTag' => $homeSection->metaTag,
            ],
            'aboutSeo' => [
                'metaTitle' => $aboutSection->metaTitle,
                'metaDescription' => $aboutSection->metaDescription,
                'metaKey' => $aboutSection->metaKey,
                'metaTag' => $aboutSection->metaTag,
            ],
            'demoSeo' => [
                'metaTitle' => $demoSection->metaTitle,
                'metaDescription' => $demoSection->metaDescription,
                'metaKey' => $demoSection->metaKey,
                'metaTag' => $demoSection->metaTag,
            ],
            'contactSeo' => [
                'metaTitle' => $contactSection->metaTitle,
                'metaDescription' => $contactSection->metaDescription,
                'metaKey' => $contactSection->metaKey,
                'metaTag' => $contactSection->metaTag,
            ],
        ] , 'success');
    }
}

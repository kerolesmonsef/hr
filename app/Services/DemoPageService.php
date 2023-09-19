<?php

namespace App\Services;
use App\Http\Controllers\Controller;
use App\Http\Resources\Landpage\DemoCardResource;
use App\Http\Resources\Landpage\SocialResource;
use App\Models\Landdemocard;
use App\Models\Landsection;
use App\Models\Landsocialmedia;
use App\Traits\ApiResponser;
class DemoPageService
{
    use ApiResponser;
    public function getData(){
        $sections = Landsection::whereIn('key' , ['demoSection','footerSection'])->get();
        $demoSection = $sections->where('key' , 'demoSection')->firstorfail();
        $landDemoCards = Landdemocard::get();
        return $this->success([
            'demoSection' => [
                'title' => $demoSection->title,
                'description' => $demoSection->description,
                'cards' => DemoCardResource::collection($landDemoCards),
            ],
            'seo' => [
                'metaTitle' => $demoSection->metaTitle,
                'metaDescription' => $demoSection->metaDescription,
                'metaKey' => $demoSection->metaKey,
                'metaTag' => $demoSection->metaTag,
            ],

        ] , 'success');
    }
}

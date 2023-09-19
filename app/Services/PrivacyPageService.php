<?php

namespace App\Services;
use App\Http\Controllers\Controller;
use App\Http\Resources\Landpage\DemoCardResource;
use App\Http\Resources\Landpage\SocialResource;
use App\Models\Landdemocard;
use App\Models\Landsection;
use App\Models\Landsocialmedia;
use App\Traits\ApiResponser;
class PrivacyPageService
{
    use ApiResponser;
    public function getData(){
        $privacySection = Landsection::whereIn('key' , ['privacySection'])->first();
        return $this->success([
            'termSection' => [
                'title' => $privacySection->title,
                'description' => $privacySection->description,
            ],
            'seo' => [
                'metaTitle' => $privacySection->metaTitle,
                'metaDescription' => $privacySection->metaDescription,
                'metaKey' => $privacySection->metaKey,
                'metaTag' => $privacySection->metaTag,
            ],
        ] , 'success');
    }
}

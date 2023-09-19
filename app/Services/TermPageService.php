<?php

namespace App\Services;
use App\Http\Controllers\Controller;
use App\Http\Resources\Landpage\DemoCardResource;
use App\Http\Resources\Landpage\SocialResource;
use App\Models\Landdemocard;
use App\Models\Landsection;
use App\Models\Landsocialmedia;
use App\Traits\ApiResponser;
class TermPageService
{
    use ApiResponser;
    public function getData(){
        $termSection = Landsection::whereIn('key' , ['termSection'])->first();
        return $this->success([
            'termSection' => [
                'title' => $termSection->title,
                'description' => $termSection->description,
            ],
            'seo' => [
                'metaTitle' => $termSection->metaTitle,
                'metaDescription' => $termSection->metaDescription,
                'metaKey' => $termSection->metaKey,
                'metaTag' => $termSection->metaTag,
            ],
        ] , 'success');
    }
}

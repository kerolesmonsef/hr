<?php

namespace App\Services;
use App\Http\Controllers\Controller;
use App\Http\Resources\Landpage\AboutCardResource;
use App\Http\Resources\Landpage\SocialResource;
use App\Models\Landaboutcard;
use App\Models\Landsection;
use App\Models\Landsocialmedia;
use App\Traits\ApiResponser;
class AboutPageService
{
    use ApiResponser;
    public function getData(){
        $sections = Landsection::whereIn('key' , ['aboutSection','purposeSection','footerSection'])->get();
        $purposeSection = $sections->where('key' , 'purposeSection')->firstorfail();
        $aboutSection = $sections->where('key' , 'aboutSection')->firstorfail();
        $aboutCards = Landaboutcard::get();
        return $this->success([
            'aboutSection' => [
                'title' => $aboutSection->title,
                'description' => $aboutSection->description,
                'image' => url('storage/' . $aboutSection->image),
                'cards' => AboutCardResource::collection($aboutCards),
            ],
            'purposeSection' => [
                'title' => $purposeSection->title,
                'description' => $purposeSection->description,
                'image' => url('storage/'.$purposeSection->image),
            ],
            'seo' => [
                'metaTitle' => $aboutSection->metaTitle,
                'metaDescription' => $aboutSection->metaDescription,
                'metaKey' => $aboutSection->metaKey,
                'metaTag' => $aboutSection->metaTag,
            ],
        ] , 'success');
    }


}

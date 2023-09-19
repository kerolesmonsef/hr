<?php

namespace App\Services;
use App\Http\Controllers\Controller;
use App\Http\Resources\Landpage\BlogResource;
use App\Http\Resources\Landpage\SocialResource;
use App\Models\Landblog;
use App\Models\Landsection;
use App\Models\Landsocialmedia;
use App\Traits\ApiResponser;
class BlogPageService
{
    use ApiResponser;
    public function getData(){
        $sections = Landsection::whereIn('key' , ['blogSection','footerSection'])->firstorfail();
        $section = $sections->where('key' , 'blogSection')->firstorfail();
        $blogs = Landblog::paginate(6);
        return $this->success([
            'title' => $section->title,
            'blogs' =>  resource_collection(BlogResource::collection($blogs)),
            'seo' => [
                'metaTitle' => $section->metaTitle,
                'metaDescription' => $section->metaDescription,
                'metaKey' => $section->metaKey,
                'metaTag' => $section->metaTag,
            ],

        ] , 'success');
    }


}

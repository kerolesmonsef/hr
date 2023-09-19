<?php

namespace App\Services;
use App\Http\Controllers\Controller;
use App\Http\Resources\Landpage\BlogResource;
use App\Http\Resources\Landpage\CloudCardResource;
use App\Http\Resources\Landpage\HelpCardResource;
use App\Http\Resources\Landpage\PlanResource;
use App\Http\Resources\Landpage\SayCardResource;
use App\Http\Resources\Landpage\SliderResource;
use App\Http\Resources\Landpage\SocialResource;
use App\Models\Landblog;
use App\Models\Landcloudcard;
use App\Models\Landhelpcard;
use App\Models\Landplan;
use App\Models\Landsaycard;
use App\Models\Landsection;
use App\Models\Landslider;
use App\Models\Landsocialmedia;
use App\Traits\ApiResponser;

class HomePageService
{

    use ApiResponser;
    public function getData(){
        $sections = Landsection::whereIn('key' , ['homeSection','cloudSection','helpSection','planSection','sliderSection','purposeSection','footerSection','saySection','blogSection'])->get();
        $headSection = $sections->where('key' , 'homeSection')->firstorfail();
        $cloudSection = $sections->where('key' , 'cloudSection')->firstorfail();
        $helpSection = $sections->where('key' , 'helpSection')->firstorfail();
        $planSection = $sections->where('key' , 'planSection')->firstorfail();
        $sliderSection = $sections->where('key' , 'sliderSection')->firstorfail();
        $purposeSection = $sections->where('key' , 'purposeSection')->firstorfail();
        $saySection = $sections->where('key' , 'saySection')->firstorfail();
        $blogSection = $sections->where('key' , 'blogSection')->firstorfail();
        $cloudcards = Landcloudcard::get();
        $helpcards = Landhelpcard::get();
        $saycards = Landsaycard::get();
        $plans = Landplan::with('features')->get();
        $blogs = Landblog::paginate(20);
        $sliders = Landslider::get();
        return $this->success([
            'headSection' => [
                'title' => $headSection->title,
                'description' => $headSection->description,
                'image' => url('storage/'.$headSection->image),
            ],
            'sliderSection' => [
                'title' => $sliderSection->title,
                'description' => $sliderSection->description,
                'sliders' => SliderResource::collection($sliders),
            ],
            'purposeSection' => [
                'title' => $purposeSection->title,
                'description' => $purposeSection->description,
                'image' => url('storage/'.$purposeSection->image),
            ],
            'cloudSection' =>[
                    'title' => $cloudSection->title,
                    'description' => $cloudSection->description,
                    'cards' => CloudCardResource::collection($cloudcards),
            ],
            'helpSection' => [
                'title' => $helpSection->title,
                'image' => url('storage/'.$helpSection->image),
                'cards' => HelpCardResource::collection($helpcards),
            ],
            'planSection' => [
                'title' => $planSection->title,
                'description' => $planSection->description,
                'plans' => [
                    'monthly' => PlanResource::collection($plans->where('dateType' , 'monthly')),
                    'yearly' => PlanResource::collection($plans->where('dateType' , 'yearly'))
                ]
            ],
            'saySection' => [
                'title' => $saySection->title,
                'cards' => SayCardResource::collection($saycards),
            ],
            'blogSection' => [
                'title' => $blogSection->title,
                'blogs' => BlogResource::collection($blogs)
            ],
            'seo' => [
                'metaTitle' => $headSection->metaTitle,
                'metaDescription' => $headSection->metaDescription,
                'metaKey' => $headSection->metaKey,
                'metaTag' => $headSection->metaTag,
            ],

        ] , 'success');
    }
}

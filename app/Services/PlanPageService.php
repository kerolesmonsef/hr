<?php

namespace App\Services;
use App\Http\Resources\Landpage\PlanResource;
use App\Http\Resources\Landpage\SocialResource;
use App\Models\Landplan;
use App\Models\Landsection;
use App\Models\Landsocialmedia;
use App\Traits\ApiResponser;

class PlanPageService
{

    use ApiResponser;
    public function getData(){
        $sections = Landsection::whereIn('key' , ['planSection','footerSection'])->get();
        $planSection = $sections->where('key' , 'planSection')->firstorfail();
        $plans = Landplan::with('features')->get();
        return $this->success([
            'planSection' => [
                'title' => $planSection->title,
                'description' => $planSection->description,
                'plans' => [
                    'monthly' => PlanResource::collection($plans->where('dateType' , 'monthly')),
                    'yearly' => PlanResource::collection($plans->where('dateType' , 'yearly'))
                ]
            ],
            'seo' => [
                'metaTitle' => $planSection->metaTitle,
                'metaDescription' => $planSection->metaDescription,
                'metaKey' => $planSection->metaKey,
                'metaTag' => $planSection->metaTag,
            ],

        ] , 'success');
    }
}

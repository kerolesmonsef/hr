<?php

namespace App\Services;
use App\Http\Resources\Landpage\ContactCardResource;
use App\Http\Resources\Landpage\SocialResource;
use App\Models\Landcontactcard;
use App\Models\Landsection;
use App\Models\Landsocialmedia;
use App\Traits\ApiResponser;
class ContactPageService
{
    use ApiResponser;
    public function getData(){
        $sections = Landsection::whereIn('key' , ['contactSection','getTouchSection','footerSection'])->get();
        $contactSection = $sections->where('key' , 'contactSection')->firstorfail();
        $getTouchSection = $sections->where('key' , 'getTouchSection')->firstorfail();
        $contactCards = Landcontactcard::get();
        return $this->success([
            'contactSection' => [
                'title' => $contactSection->title,
            ],
            'getTouchSection' => [
                'title' => $getTouchSection->title,
                'description' => $getTouchSection->description,
                'image' => url('storage/' . $getTouchSection->image),
                'cards' => [
                    'find_us_at' => ContactCardResource::collection($contactCards->where('type' , 'location')),
                    'reach_us' => ContactCardResource::collection($contactCards->where('type' ,'!=', 'location')),
                ],
            ],
            'seo' => [
                'metaTitle' => $contactSection->metaTitle,
                'metaDescription' => $contactSection->metaDescription,
                'metaKey' => $contactSection->metaKey,
                'metaTag' => $contactSection->metaTag,
            ],

        ] , 'success');
    }
}

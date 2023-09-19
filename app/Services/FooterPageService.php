<?php

namespace App\Services;
use App\Http\Resources\Landpage\SocialResource;
use App\Models\Landsection;
use App\Models\Landsocialmedia;
use App\Traits\ApiResponser;
class FooterPageService
{
    use ApiResponser;
    public function getData(){
        $footerSection = Landsection::where('key' ,'footerSection')->firstorfail();
        $socials = Landsocialmedia::get();
        return $this->success([

            'footerSecion' => [
                'description' => $footerSection->description,
                'social' => $socials->pluck('url' ,'type'),
            ]
        ] , 'success');
    }
}

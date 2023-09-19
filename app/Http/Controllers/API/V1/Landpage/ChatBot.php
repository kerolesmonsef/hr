<?php

namespace App\Http\Controllers\API\V1\Landpage;

use App\Http\Controllers\Controller;
use App\Http\Resources\Landpage\FaqResource;
use App\Models\Landfaq;
use App\Traits\ApiResponser;


class ChatBot extends Controller
{
    use ApiResponser;
    public function index(){
        $faqs = Landfaq::get();
        return $this->success([
                'chatbot' => FaqResource::collection($faqs),
        ] , 'success' );
    }
}

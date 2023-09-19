<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferCategoryResource;
use App\Models\OfferCategory;
use Illuminate\Http\Request;

class OfferCategoryController extends Controller
{
    public function __invoke(){
        $data = OfferCategory::get();
        return $this->success(OfferCategoryResource::collection($data));
    }
}

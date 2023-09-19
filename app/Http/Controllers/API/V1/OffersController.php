<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //TODO: add group by category
        $offers = Offer::where('offer_category_id' ,  $request->offer_category_id)->latest()->when($request->filled('offers_limit'), function ($q) {
            return $q->take(request('offers_limit'));
        })->simplePaginate();
        return $this->success(resource_collection(OfferResource::collection($offers)));

    }
}

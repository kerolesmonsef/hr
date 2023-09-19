<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Offers-List', ['only' => ['index']]);
        $this->middleware('permission:Offers-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Offers-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Offers-Delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offers = Offer::query()->when($request->filled('search'), function ($q) {
            $q->where('name', 'like', "%" . request('search') . "%");
        })->when(request('fromDate'), function ($q) {
             $q->where('created_at', '>=', request('fromDate'));
        })->when(request('toDate'), function ($q) {
            $q->where('created_at', '<=', request('toDate'));
        })->get();

        if ($request->ajax()) {
            $search = view('new-theme.offers.offers-data', compact("offers"));
            return response()->json(['search' => $search->render()]);
        }
        return view('new-theme.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->edit(new Offer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\OfferRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {
        $dates = explode(" to ", $request->get('end_date'));

        $start_date = $dates[0] ?? now()->format('Y-m-d');
        $end_date   = $dates[1] ?? now()->format('Y-m-d');

        Offer::query()->create(array_merge($request->validated(), [
            'photo'      => FileHelper::upload_file('offers', $request->file('photo')),
            'start_date' => $start_date,
            'end_date'   => $end_date
        ]));

        return redirect()->route("offers.index")->with("success", __("Created Successfully"));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        return $this->edit($offer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        return view('new-theme.offers.create', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request, Offer $offer)
    {
        $dates = explode(" to ", $request->get('end_date'));

        $start_date = $dates[0] ?? now()->format('Y-m-d');
        $end_date = $dates[1] ?? now()->format('Y-m-d');


        $offer->update(array_merge($request->validated(), [
            'photo' => $request->file('photo') ? FileHelper::upload_file('offers', $request->file('photo')) : $offer->photo,
            'start_date' => $start_date,
            'end_date' => $end_date
        ]));

        return redirect()->route("offers.index")->with("success", __("Updated Successfully"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()->route("offers.index")->with("success", __("Deleted Successfully"));
    }
}

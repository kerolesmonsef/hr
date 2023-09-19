<?php

namespace App\Http\Controllers\Landpage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landpage\StoreFeature;
use App\Http\Requests\Landpage\UpdateFeature;
use App\Models\Landblog;
use App\Models\Landfeature;
use App\Models\Landplan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeatureController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $rows = Landfeature::with('plan')->paginate(10);
        return view('Landpage.Feature.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        $row = null;
        $case = 'create';
        $plans = Landplan::get();
        if (request()->has('id')) {
            $case = 'update';
            $row = Landfeature::findorfail(request()->get('id'));
        }
        return view('Landpage.Feature.form', compact('row', 'case' ,'plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeature $request)
    {
        $data = $request->validated();
        if(isset($data['image'])){
            $image =  $request->file('image')->store('uploads');
            $data['image'] = $image;
        }
        Landblog::create($data);
        return redirect()->route('landpage.landfeature')->with(['success' => __('messages.Item was updated successfully')]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeature $request, $id)
    {
        $data = $request->validated();
        $row = Landfeature::findOrfail($id);
        if(isset($data['image'])){
            $image =  $request->file('image')->store('uploads');
            Storage::delete($row->image);
            $data['image'] = $image;
        }
        $row->update($data);
        return redirect()->route('landpage.landfeature')->with(['success' => __('messages.Item was updated successfully')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $row = Landfeature::findorfail($id);
        $row->delete();
        return redirect()->back()->with(['success' =>  __('messages.Item was deleted successfully')]);
    }
}

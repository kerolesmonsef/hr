<?php

namespace App\Http\Controllers\Landpage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landpage\StoreLandSayCard;
use App\Http\Requests\Landpage\UpdateLandSayCard;
use App\Models\Landsaycard;
use Illuminate\Support\Facades\Storage;

class LandSayCardController extends Controller
{
    //
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Landsaycard::paginate(10);
        return view('Landpage.Saycard.index', compact('rows' ));
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
        if (request()->has('id')) {
            $case = 'update';
            $row = Landsaycard::findorfail(request()->get('id'));
        }
        return view('Landpage.Saycard.form', compact('row', 'case'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLandSayCard $request)
    {
        $data = $request->validated();
        if(isset($data['image'])){
            $image =  $request->file('image')->store('uploads');
            $data['image'] = $image;
        }
        Landsaycard::create($data);
        return redirect()->route('landpage.landsaycard')->with(['success' => __('messages.Item was updated successfully')]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLandSayCard $request, $id)
    {
        //
        $data = $request->validated();
        $row = Landsaycard::findOrfail($id);
        if(isset($data['image'])){
            $image =  $request->file('image')->store('uploads');
            Storage::delete($row->image);
            $data['image'] = $image;
        }
        $row->update($data);
        return redirect()->route('landpage.landsaycard')->with(['success' => __('messages.Item was updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $row = Landsaycard::findorfail($id);
        $row->delete();
        return redirect()->back()->with(['success' =>  __('messages.Item was deleted successfully')]);
    }
}

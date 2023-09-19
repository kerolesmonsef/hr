<?php

namespace App\Http\Controllers\Landpage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landpage\StoreLandHelpCard;
use App\Http\Requests\Landpage\UpdateLandHelpCard;
use App\Models\Landhelpcard;
use Illuminate\Support\Facades\Storage;

class LandHelpCardController extends Controller
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
        $rows = Landhelpcard::paginate(10);
        return view('Landpage.Helpcard.index', compact('rows' ));
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
            $row = Landhelpcard::findorfail(request()->get('id'));
        }
        return view('Landpage.Helpcard.form', compact('row', 'case'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLandHelpCard $request)
    {
        $data = $request->validated();
        if(isset($data['image'])){
            $image =  $request->file('image')->store('uploads');
            $data['image'] = $image;
        }
        Landhelpcard::create($data);
        return redirect()->route('landpage.landhelpcard')->with(['success' => __('messages.Item was added successfully')]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLandHelpCard $request, $id)
    {
        //
        $data = $request->validated();
        $row = Landhelpcard::findOrfail($id);
        if(isset($data['image'])){
            $image =  $request->file('image')->store('uploads');
            Storage::delete($row->image);
            $data['image'] = $image;
        }
        $row->update($data);
        return redirect()->route('landpage.landhelpcard')->with(['success' => __('messages.Item was updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $row = Landhelpcard::findorfail($id);
        $row->delete();
        return redirect()->back()->with(['success' =>  __('messages.Item was deleted successfully')]);
    }
}

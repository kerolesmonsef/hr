<?php

namespace App\Http\Controllers\Landpage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landpage\StoreLandCloudCard;
use App\Http\Requests\Landpage\StoreLandContactCard;
use App\Http\Requests\Landpage\UpdateLandCloudCard;
use App\Http\Requests\Landpage\UpdateLandContactCard;
use App\Models\Landcontactcard;
use Illuminate\Support\Facades\Storage;

class LandContactCardController extends Controller
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
        $rows = Landcontactcard::paginate(10);
        return view('Landpage.Contactcard.index', compact('rows' ));
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
            $row = Landcontactcard::findorfail(request()->get('id'));
        }
        return view('Landpage.Contactcard.form', compact('row', 'case'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLandContactCard $request)
    {
        $data = $request->validated();
        if(isset($data['image'])){
            $image =  $request->file('image')->store('uploads');
            $data['image'] = $image;
        }
        Landcontactcard::create($data);
        return redirect()->route('landpage.landcontactcard')->with(['success' => __('messages.Item was updated successfully')]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLandContactCard $request, $id)
    {
        //
        $data = $request->validated();
        $row = Landcontactcard::findOrfail($id);
        if(isset($data['image'])){
            $image =  $request->file('image')->store('uploads');
            Storage::delete($row->image);
            $data['image'] = $image;
        }
        $row->update($data);
        return redirect()->route('landpage.landcontactcard')->with(['success' => __('messages.Item was updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $row = landcontactcard::findorfail($id);
        $row->delete();
        return redirect()->back()->with(['success' =>  __('messages.Item was deleted successfully')]);
    }
}

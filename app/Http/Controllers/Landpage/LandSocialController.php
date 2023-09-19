<?php

namespace App\Http\Controllers\Landpage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landpage\StoreLandSocial;
use App\Http\Requests\Landpage\UpdateLandSocial;
use App\Models\Landsocialmedia;
use App\Models\Landsupportform;

class LandSocialController extends Controller
{
    public function index(){
        $rows = Landsocialmedia::paginate(10);
        return view('Landpage.Social.index' , compact('rows'));
    }
    public function form(){
        $row = null;
        $case = 'create';
        $types = ['twitter','facebook','instagram','youtube','googleplus','linkedin'];
        if (request()->has('id')) {
            $case = 'update';
            $row = Landsocialmedia::findorfail(request()->get('id'));
        }
        return view('Landpage.Social.form', compact('row', 'case','types'));
    }
    public function update(UpdateLandSocial $request , $id){
        $data = $request->validated();
         $row = Landsocialmedia::findOrfail($id);
         $row->update($data);
         return redirect()->route('landpage.landsocial')->with(['success' => __('messages.Item was updated successfully')]);
    }
    public function store(StoreLandSocial $request)
    {
        $data = $request->validated();
        Landsocialmedia::create($data);
        return redirect()->route('landpage.landsocial')->with(['success' => __('messages.Item was updated successfully')]);
    }
    public function delete($id)
    {
        $row = Landsocialmedia::findorfail($id);
        $row->delete();
        return redirect()->back()->with(['success' =>  __('messages.Item was deleted successfully')]);
    }
}

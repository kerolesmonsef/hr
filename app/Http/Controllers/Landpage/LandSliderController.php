<?php

namespace App\Http\Controllers\Landpage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landpage\StoreLandSlider;
use App\Http\Requests\Landpage\UpdateLandSlider;
use App\Models\Landslider;
use Illuminate\Support\Facades\Storage;

class LandSliderController extends Controller
{
    public function index(){
        $rows = Landslider::paginate(10);
        return view('Landpage.Slider.index' , compact('rows'));
    }
    public function form(){
        $row = null;
        $case = 'create';
        if (request()->has('id')) {
            $case = 'update';
            $row = Landslider::findorfail(request()->get('id'));
        }
        return view('Landpage.Slider.form', compact('row', 'case'));
    }
    public function update(UpdateLandSlider $request , $id){
        $data = $request->validated();
        $row = Landslider::findOrfail($id);
         if(isset($data['image'])){
             $image =  $request->file('image')->store('uploads');
             Storage::delete($row->image);
             $data['image'] = $image;
         }
         $row->update($data);
         return redirect()->route('landpage.landslider')->with(['success' => __('messages.Item was updated successfully')]);
    }
    public function store(StoreLandSlider $request)
    {
        $data = $request->validated();
        if(isset($data['image'])){
            $image =  $request->file('image')->store('uploads');
            $data['image'] = $image;
        }
        Landslider::create($data);
        return redirect()->route('landpage.landslider')->with(['success' => __('messages.Item was updated successfully')]);
    }
    public function delete($id)
    {
        $row = Landslider::findorfail($id);
        $row->delete();
        return redirect()->back()->with(['success' =>  __('messages.Item was deleted successfully')]);
    }
}

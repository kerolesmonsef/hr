<?php

namespace App\Http\Controllers\Landpage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landpage\UpdateSection;
use App\Models\Landsection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function index(){
        $rows = Landsection::paginate(10);
        return view('Landpage.Section.index' , compact('rows'));
    }
    public function form(){
        $row = null;
        $case = 'update';
        $row = Landsection::findorfail(request()->get('id'));
        return view('Landpage.Section.form' , compact('row','case'));
    }
    public function update(UpdateSection $request , $id){
        $data = $request->validated();
         $row = Landsection::findOrfail($id);
         if(isset($data['image'])){
             $image =  $request->file('image')->store('uploads');
             Storage::delete($row->image);
             $data['image'] = $image;
         }
         $row->update($data);
         return redirect()->route('landpage.section')->with(['success' => __('messages.Item was updated successfully')]);
    }
}

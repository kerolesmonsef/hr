<?php

namespace App\Http\Controllers\Landpage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landpage\StoreLandPlan;
use App\Http\Requests\Landpage\UpdateLandPlan;
use App\Models\Landplan;
use Illuminate\Support\Facades\Storage;
class LandPlanController extends Controller
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
        $rows = Landplan::paginate(10);
        return view('Landpage.Plan.index', compact('rows' ));
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
        $types = ['lite' ,'regular','pro'];
        $datetypes = ['monthly' ,'yearly'];
        if (request()->has('id')) {
            $case = 'update';
            $row = Landplan::findorfail(request()->get('id'));
        }
        return view('Landpage.Plan.form', compact('row', 'case','types','datetypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLandPlan $request)
    {
        $data = $request->validated();
        Landplan::create($data);
        return redirect()->route('landpage.landplan')->with(['success' => __('messages.Item was updated successfully')]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLandPlan $request, $id)
    {
        //
        $data = $request->validated();
        $row = Landplan::findOrfail($id);
        $row->update($data);
        return redirect()->route('landpage.landplan')->with(['success' => __('messages.Item was updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $row = Landplan::findorfail($id);
        $row->delete();
        return redirect()->back()->with(['success' =>  __('messages.Item was deleted successfully')]);
    }
}

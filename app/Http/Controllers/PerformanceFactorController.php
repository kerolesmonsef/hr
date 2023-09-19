<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewTheme\PerformanceFactorRequest;
use App\Models\PerformanceFactor;
use App\Models\PerformancePeriod;
use Illuminate\Http\Request;

class PerformanceFactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:PerformanceFactor-List', ['only' => ['index']]);
        $this->middleware('permission:PerformanceFactor-Create', ['only' => ['create','store']]);
        $this->middleware('permission:PerformanceFactor-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:PerformanceFactor-Delete', ['only' => ['destroy']]);
    }



    public function index(Request $request)
    {
        $performancefactors = PerformanceFactor::query()
        ->when($request->filled('search'), function ($q) {
            $q->where('name', 'like', "%" . request('search') . "%")->orWhere('name_ar', 'like', "%" . request('search') . "%");
        })->with('performanceperiod')->paginate();
        $performanceperiods = PerformancePeriod::get();


    if ($request->ajax()) {
        $search   = view('new-theme.settings.performance-s.performancefactor', compact('performancefactors','performanceperiods'));
        $paginate = view('new-theme.settings.performance-s.components.paginate', compact('performancefactors','performanceperiods'));
        return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
    }
        return view('new-theme.settings.performance-s.index',compact('performancefactors','performanceperiods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerformanceFactorRequest $request)
    {
        $data = $request->validated();
        PerformanceFactor::create($data);
        flash()->addSuccess(__('Added successfully'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PerformanceFactorRequest $request, $id)
    {
        $row  = PerformanceFactor::findorfail($id);
        $data = $request->validated();
        $row->update($data);
        flash()->addSuccess(__('Updated successfully'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = PerformanceFactor::findorfail($id);
        $row->delete();
        flash()->addSuccess(__('Deleted successfully'));
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\PerformanceExport;
use App\Http\Requests\NewTheme\PerformanceRequest;
use App\Models\Employee;
use App\Models\Performance;
use App\Models\Performance_Type;
use App\Models\PerformanceDetails;
use App\Models\PerformanceFactor;
use App\Models\PerformancePeriod;
use App\Services\PerformanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PerformanceController extends Controller
{
    private PerformanceService $performanceService;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:Performance-List', ['only' => ['index']]);
        $this->middleware('permission:Performance-Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Performance-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Performance-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Performance-Export', ['only' => ['export']]);
        $this->middleware('permission:Performance-Print', ['only' => ['print']]);
        $this->performanceService = new PerformanceService();
    }


    public function index(Request $request)
    {
        $performance = Performance::query();

        $this->performanceService->filter($performance);

        $performance = $performance->paginate(10);
        if ($request->ajax()) {
            $search = view('new-theme.employee.performance.performance', compact("performance"));
            return response()->json([
                'search' => $search->render()
            ]);
        }

        return view('new-theme.employee.performance.index', compact('performance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $performance_periods = PerformancePeriod::get();
        $employees = Employee::where('is_active', 1)->get();
        return view('new-theme.employee.performance.create', compact('performance_periods', 'employees'));
    }

    public function create_ajax(Request $request)
    {
        $performanceFactors = PerformanceFactor::where('performance_period_id', $request->search)->get();
        $search = view('new-theme.employee.performance.add', compact("performanceFactors"));
        return response()->json([
            'search' => $search->render()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerformanceRequest $request)
    {
        $data = $request->validated();
        $data['date'] = Carbon::now();
        unset($data['performance']);
        $newperformance = Performance::create($data);

        $performances = $request->performance;

        foreach ($performances as $key => $performance) {
            $performanceDetails = new PerformanceDetails();
            $performanceDetails->performance_id = $newperformance->id;
            $performanceDetails->performance_factor = $performance['factor'];
            $performanceDetails->points = $performance['option'];
            $performanceDetails->notes = $performance['notes'];
            $performanceDetails->save();
        }

        flash()->addSuccess(__('Added successfully'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $performance = Performance::findorfail($id);
        $performanceDetails = PerformanceDetails::where('performance_id', $id)->get();
        $performance_periods = PerformancePeriod::get();
        $employees = Employee::where('is_active', 1)->get();
        return view('new-theme.employee.performance.edit', compact('performance', 'performance_periods', 'performanceDetails', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Performance::where('id', $id)->update(['rate' => $request->rate]);
        foreach ($request->performance as $detail) {
            unset($detail['option']);
            PerformanceDetails::where('id', $detail['id'])->update($detail);
        }

        flash()->addSuccess(__('Updated successfully'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Performance $performance)
    {
        $performance->details()->delete();
        $performance->delete();
        flash()->addSuccess(__('Deleted successfully'));
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new PerformanceExport(), 'performance.xlsx');
    }

    public function print()
    {
        return (new PerformanceExport())->view();
    }
}

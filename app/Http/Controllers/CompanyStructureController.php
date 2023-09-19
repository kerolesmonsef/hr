<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyStructureListResource;
use App\Models\CompanyStructure;
use App\Models\CompanyStructureEmployee;
use App\Models\Employee;
use Illuminate\Http\Request;

class CompanyStructureController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:companyStructures-List', ['only' => ['companyStructure']]);
        $this->middleware('permission:companyStructures-Assign', ['only' => ['assign']]);
    }

    public function index()
    {
        $lang              = app()->getLocale() == 'ar' ? '_ar' : '';
        $CompanyStructures = CompanyStructure::groupBy('structure_key')->get();
        $employees         = Employee::get();
        return view('new-theme.structure-list.index', compact('lang','CompanyStructures', 'employees'));
    }


    public function create(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        \request()->validate([
            'name'         => 'required',
            'name_ar'      => 'required',
            'numberOfRows' => 'required',
        ]);

        $itemArr = [];
        for($i = 0 ; $i < $request->numberOfRows ; $i++ ){
            array_push($itemArr,[
                'name'             => $request->name,
                'name_ar'          => $request->name_ar,
                'structure_key'    => str_replace(' ','_',$request->name),
                'parent'           => $request->parent != "" ? $request->parent : null,
                'created_by'       => auth()->user()->creatorId(),
            ]);
        }

        CompanyStructure::insert($itemArr);
        return back()->with('success', __('Added Successfully'));
    }

    public function companyStructure()
    {
        $lang              = app()->getLocale() == 'ar' ? '_ar' : '';
        $CompanyStructures = CompanyStructure::with('employee');
        $structureLists    = $CompanyStructures->get();
        $lists             = $CompanyStructures->groupBy('structure_key')->get();
        $employees         = Employee::where('is_active', 1)->get();
        $CompanyStructures = CompanyStructureListResource::collection($structureLists);
        return view('new-theme.structure-list.structure', compact('CompanyStructures', 'employees','lists', 'structureLists', 'lang'));
    }

    public function assign(Request $request)
    {
        \request()->validate([
            'structure_id'    => 'required',
            'employees'       => 'required',
        ]);

        $employees                  = $request->employees;
        $parentKey                  = CompanyStructure::where('id', $request->structure_id)->value('parent');
        $CompanyStructuresIds       = CompanyStructure::where('parent',$parentKey)->whereNull('employee_id')->pluck('id')->toArray();

        if(count($employees) > count($CompanyStructuresIds)){
            return back()->with('error', __('The number of employees must be equal to or less than the number available for the job in the organizational structure'));
        }

        for($i = 0 ; $i < count($employees) ; $i++){
            CompanyStructure::where('id', $CompanyStructuresIds[$i])->update(['employee_id' => $employees[$i]]);
        }

        return back()->with('success', __('Added successfully'));
    }

    public function show(CompanyStructure $companystructure)
    {
        //
    }

    public function edit(CompanyStructure $companystructure)
    {
        //
    }

    public function update(Request $request, CompanyStructure $companystructure)
    {
        \request()->validate([
            'name'        => 'required',
            'name_ar'     => 'required',
        ]);

        $CompanyStructures   = CompanyStructure::where('structure_key',$companystructure->structure_key);
        $all                 = $CompanyStructures->count();
        $unassigned          = $CompanyStructures->whereNull('employee_id');
        $numberOfRows        = $request->numberOfRows;

        if($numberOfRows > $all)
        {
            $rows    = $numberOfRows - $all;
            $itemArr = [];
            for($i = 0 ; $i < $rows ; $i++ ){
                array_push($itemArr,[
                    'name'             => $request->name,
                    'name_ar'          => $request->name_ar,
                    'structure_key'    => str_replace(' ','_',$request->name),
                    'parent'           => $request->parent != "" ? $request->parent : null,
                    'created_by'       => auth()->user()->creatorId(),
                ]);
            }

            CompanyStructure::insert($itemArr);
        }elseif($all > $numberOfRows)
        {
            $rows    = $all - $numberOfRows;
           if($rows > $unassigned->count()){
                return back()->with('error', __('Minimum number of rows is '.$unassigned->count()));
           }
           $unassigned->limit($rows)->delete();

        }elseif($all == $numberOfRows){
            $companystructure->name          = $request->name;
            $companystructure->name_ar       = $request->name_ar;
            $companystructure->structure_key =  str_replace(' ','_',$request->name);
            $companystructure->parent        =  $request->parent != "" ? $request->parent : null;
            $companystructure->save();
        }

        return back()->with('success', __('Updated successfully'));
    }

    public function destroy(CompanyStructure $companystructure)
    {
        $assigned          = CompanyStructure::where('structure_key',$companystructure->structure_key)->whereNotNull('employee_id')->count();
        if($assigned > 0){
            return back()->with('error', __('Not allowed To Delete This Item Because It Assigned To Employees'));
        }
        $assigned->delete();
        return redirect()->route('companystructure.index')->with('success', __('Deleted successfully'));
    }
}

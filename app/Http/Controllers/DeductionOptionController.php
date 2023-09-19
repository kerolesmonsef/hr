<?php

namespace App\Http\Controllers;

use App\Models\DeductionOption;
use Illuminate\Http\Request;

class DeductionOptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:DeductionOption-List', ['only' => ['index']]);
        $this->middleware('permission:DeductionOption-Create', ['only' => ['store']]);
        $this->middleware('permission:DeductionOption-Edit', ['only' => ['update']]);
        $this->middleware('permission:DeductionOption-Delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $deductionoptions = DeductionOption::query();

        if (request()->ajax()) {
            $deductionoptions->where(function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('name_ar', 'like', '%' . request('search') . '%');
            });
            $search = view('new-theme.settings.salary.paginations.deductionoption_pagination', [
                'deductionoptions' => $deductionoptions->get(),
            ]);
            return response()->json(['search' => $search->render()]);
        }


        $deductionoptions = $deductionoptions->get();

        return view('new-theme.settings.salary.deductionoptions', compact('deductionoptions'));


    }

    public function store(Request $request)
    {
        \request()->validate([
                'name' => 'required',
                'name_ar' => 'required',
            ]
        );

        $deductionoption = new DeductionOption();
        $deductionoption->name = $request->name;
        $deductionoption->name_ar = $request->name_ar;
        $deductionoption->created_by = auth()->user()->creatorId();
        $deductionoption->save();

        return redirect()->route('deductionoption.index')->with('success', __('DeductionOption  successfully created.'));
    }


    public function update(Request $request, DeductionOption $deductionoption)
    {
        \request()->validate([
                'name' => 'required',
                'name_ar' => 'required',
            ]
        );

        $deductionoption->name = $request->name;
        $deductionoption->name_ar = $request->name_ar;
        $deductionoption->save();

        return redirect()->route('deductionoption.index')->with('success', __('DeductionOption successfully updated.'));
    }

    public function destroy(DeductionOption $deductionoption)
    {
        $deductionoption->delete();
        return redirect()->route('deductionoption.index')->with('success', __('DeductionOption successfully deleted.'));
    }
}

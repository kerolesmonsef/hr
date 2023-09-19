<?php

namespace App\Http\Controllers;

use App\Models\LoanOption;
use Illuminate\Http\Request;

class LoanOptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:LoanOption-List', ['only' => ['index']]);
        $this->middleware('permission:LoanOption-Create', ['only' => ['store']]);
        $this->middleware('permission:LoanOption-Edit', ['only' => ['update']]);
        $this->middleware('permission:LoanOption-Delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $loanoptions = LoanOption::query();

        if (request()->ajax()) {
            $loanoptions->where(function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('name_ar', 'like', '%' . request('search') . '%');
            });
            $search = view('new-theme.settings.salary.paginations.loanoption_pagination', [
                'loanoptions' => $loanoptions->get(),
            ]);
            return response()->json(['search' => $search->render()]);
        }

        $loanoptions = $loanoptions->get();

        return view('new-theme.settings.salary.loanoptions', compact('loanoptions'));
    }

    public function store(Request $request)
    {
        \request()->validate([
            'name' => 'required|max:20',
            'name_ar' => 'required|max:20',
        ]);
            
        $loanoption             = new LoanOption();
        $loanoption->name       = $request->name;
        $loanoption->name_ar       = $request->name_ar;
        $loanoption->created_by = auth()->user()->creatorId();
        $loanoption->save();

        return redirect()->route('loanoption.index')->with('success', __('LoanOption  successfully created.'));

    }



    public function update(Request $request, LoanOption $loanoption)
    {
        \request()->validate([
            'name' => 'required|max:20',
            'name_ar' => 'required|max:20',
        ]);
              
        $loanoption->name = $request->name;
        $loanoption->name_ar = $request->name_ar;
        $loanoption->save();

        return redirect()->route('loanoption.index')->with('success', __('LoanOption successfully updated.'));
    }

    public function destroy(LoanOption $loanoption)
    {
        $loanoption->delete();
        return redirect()->route('loanoption.index')->with('success', __('LoanOption successfully deleted.'));
    }

}

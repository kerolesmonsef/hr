<?php

namespace App\Http\Controllers;

use App\Models\PayslipType;
use Illuminate\Http\Request;

class PayslipTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:PayslipType-List', ['only' => ['index']]);
        $this->middleware('permission:PayslipType-Create', ['only' => ['store']]);
        $this->middleware('permission:PayslipType-Edit', ['only' => ['update']]);
        $this->middleware('permission:PayslipType-Delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $paysliptypes = PayslipType::query();

        $paysliptypes->when(request('search'), function ($query){
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('name_ar', 'like', '%' . request('search') . '%');
        });

        $paysliptypes = $paysliptypes->get();

        if (request()->ajax()) {
            $search = view('new-theme.settings.salary.paginations.paysliptype_pagination', [
                'paysliptypes' => $paysliptypes,
            ]);
            return response()->json(['search' => $search->render()]);
        }
        
        return view('new-theme.settings.salary.paysliptype', compact('paysliptypes'));
    }

    public function store(Request $request)
    {
        \request()->validate([
            'name'    => 'required|max:20',
            'name_ar' => 'required|max:20',
        ]);
        
        $paysliptype = new PayslipType();
        $paysliptype->name = $request->name;
        $paysliptype->name_ar = $request->name_ar;
        $paysliptype->created_by = auth()->user()->creatorId();
        $paysliptype->save();

        return redirect()->route('paysliptype.index')->with('success', __('PayslipType successfully created.'));

    }

    public function update(Request $request, PayslipType $paysliptype)
    {
        \request()->validate([
            'name'    => 'required|max:20',
            'name_ar' => 'required|max:20',
        ]);

        $paysliptype->name = $request->name;
        $paysliptype->name_ar = $request->name_ar;
        $paysliptype->save();

        return redirect()->route('paysliptype.index')->with('success', __('PayslipType successfully updated.'));
    }

    public function destroy(PayslipType $paysliptype)
    {
        $paysliptype->delete();
        return redirect()->route('paysliptype.index')->with('success', __('PayslipType successfully deleted.'));
    }


}

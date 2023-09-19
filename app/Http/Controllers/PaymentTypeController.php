<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:PaymentType-List', ['only' => ['index']]);
        $this->middleware('permission:PaymentType-Create', ['only' => ['store']]);
        $this->middleware('permission:PaymentType-Edit', ['only' => ['update']]);
        $this->middleware('permission:PaymentType-Delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $paymenttypes = PaymentType::query();

        if (request()->ajax()) {
            $paymenttypes->where(function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            });
            $search = view('new-theme.settings.salary.paginations.paymenttype_pagination', [
                'paymenttypes' => $paymenttypes->get(),
            ]);
            return response()->json(['search' => $search->render()]);
        }

        $paymenttypes = $paymenttypes->get();

        return view('new-theme.settings.salary.paymenttypes', compact('paymenttypes'));
    }



    public function store(Request $request)
    {
        \request()->validate([
            'name' => 'required',
        ]);

        $paymenttype             = new PaymentType();
        $paymenttype->name       = $request->name;
        $paymenttype->created_by = auth()->user()->creatorId();
        $paymenttype->save();

        return redirect()->route('paymenttype.index')->with('success', __('PaymentType  successfully created.'));
    }

    public function update(Request $request, PaymentType $paymenttype)
    {
        \request()->validate([
            'name' => 'required|max:20',
        ]);

        $paymenttype->name = $request->name;
        $paymenttype->save();

        return redirect()->route('paymenttype.index')->with('success', __('PaymentType successfully updated.'));
    }

    public function destroy(PaymentType $paymenttype)
    {
        $paymenttype->delete();
        return redirect()->route('paymenttype.index')->with('success', __('PaymentType successfully deleted.'));
    }
}

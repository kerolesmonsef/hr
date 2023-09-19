<?php

namespace App\Http\Controllers;

use App\Models\AwardType;
use Illuminate\Http\Request;

class AwardTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:AwardType-List', ['only' => ['index']]);
        $this->middleware('permission:AwardType-Create', ['only' => ['store']]);
        $this->middleware('permission:AwardType-Edit', ['only' => ['update']]);
        $this->middleware('permission:AwardType-Delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $awardtypes = AwardType::query();

        if (request()->ajax()){
            $awardtypes->where(function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('name_ar', 'like', '%' . request('search') . '%');
            });
            $search = view('new-theme.settings.salary.paginations.awardtype_pagination', [
                'awardtypes' => $awardtypes->get(),
            ]);
            return response()->json(['search' => $search->render()]);
        }
         $awardtypes = $awardtypes->get();

        return view('new-theme.settings.salary.awardtypes', compact('awardtypes'));
    }

    public function store(Request $request)
    {
        \request()->validate([
            'name' => 'required|max:20',
            'name_ar' => 'required|max:20',
        ]);

        $awardtype             = new AwardType();
        $awardtype->name       = $request->name;
        $awardtype->name_ar       = $request->name_ar;
        $awardtype->created_by = auth()->user()->creatorId();
        $awardtype->save();

        return redirect()->route('awardtype.index')->with('success', __('AwardType successfully created.'));
    }

    public function update(Request $request, AwardType $awardtype)
    {
        \request()->validate([
            'name' => 'required|max:20',
            'name_ar' => 'required|max:20',
        ]);

        $awardtype->name = $request->name;
        $awardtype->name_ar = $request->name_ar;
        $awardtype->save();

        return redirect()->route('awardtype.index')->with('success', __('AwardType successfully updated.'));
    }

    public function destroy(AwardType $awardtype)
    {
        $awardtype->delete();
        return redirect()->route('awardtype.index')->with('success', __('AwardType successfully deleted.'));
    }
}

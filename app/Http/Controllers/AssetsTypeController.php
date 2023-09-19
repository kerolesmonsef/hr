<?php

namespace App\Http\Controllers;

use App\Models\AssetsType;
use Illuminate\Http\Request;

class AssetsTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:AssetTypes-List', ['only' => ['index']]);
        $this->middleware('permission:AssetTypes-Create', ['only' => ['create','store']]);
        $this->middleware('permission:AssetTypes-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:AssetTypes-Delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $types = AssetsType::query()->latest();


        if (request()->ajax()) {
            $types = $types
                ->where('name', 'like', '%' . request('search') . '%');

            $search = view('new-theme.settings.assets-types.assets-types', [
                'types' => $types->get(),
            ]);
            return response()->json(['search' => $search->render()]);
        }

        return view('new-theme.settings.assets-types.index', [
            'types' => $types->get(),
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        AssetsType::create($data);

        flash()->addSuccess(__('Added successfully'));
        return redirect()->route("assets-types.index");
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);
        $company = AssetsType::find($id);
        $company->update($data);
        return redirect()->route('assets-types.index')->with('success', __('Insurance company successfully updated.'));
    }


    public function destroy($id)
    {
        AssetsType::find($id)->delete();
        return redirect()->route('assets-types.index')->with('success', __('Insurance company successfully deleted.'));
    }

}

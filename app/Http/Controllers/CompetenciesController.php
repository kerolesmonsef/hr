<?php

namespace App\Http\Controllers;

use App\Models\Competencies;
use App\Models\Performance_Type;
use Illuminate\Http\Request;

class CompetenciesController extends Controller
{

    public function index(Request $request)
    {
        $types = Performance_Type::get()->pluck('name', 'id');

        $competencies = Competencies::with('getPerformance_type')
            ->when($request->filled('search'), function ($q) {
                $q->where('name', 'like', "%" . request('search') . "%");
            })->paginate();


        if ($request->ajax()) {
            $search   = view('new-theme.settings.performance.performances-table', compact('competencies', 'types'));
            $paginate = view('new-theme.settings.performance.paginate', compact('competencies'));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }



        return view('new-theme.settings.performance.index', compact('competencies', 'types'));

        // return view('competencies.index', compact('competencies'));

    }




    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'type' => 'required|numeric|exists:performance__types,id'
        ]);

        $competencies             = new Competencies();
        $competencies->name       = $request->name;
        $competencies->type       = $request->type;
        $competencies->created_by = auth()->user()->creatorId();
        $competencies->save();

        return redirect()->route('competencies.index')->with('success', __('Competencies  successfully created.'));
    }


    public function show(Competencies $competencies)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|numeric|exists:performance__types,id'
        ]);
        $competencies       = Competencies::find($id);
        $competencies->name = $request->name;
        $competencies->type = $request->type;
        $competencies->save();
        return response()->json();
    }

    public function destroy($id)
    {
        $competencies = Competencies::find($id);
        $competencies->delete();

        return redirect()->route('competencies.index')->with('success', __('Competencies  successfully deleted.'));
    }
}

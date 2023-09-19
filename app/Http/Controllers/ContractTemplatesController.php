<?php

namespace App\Http\Controllers;

use App\Models\ContractTemplate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContractTemplatesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:ContractTemplates-List', ['only' => ['index']]);
        $this->middleware('permission:ContractTemplates-Create', ['only' => ['create','store']]);
        $this->middleware('permission:ContractTemplates-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:ContractTemplates-Delete', ['only' => ['destroy']]);
    }


    public function index(Request $request){
        $templates = ContractTemplate::latest();
        if(request('search')){
            $templates = $templates->where(function($q){
                $q->where('name' , 'like' , '%'.request('search').'%')
                  ->orwhere('date'  , 'like' , '%'.request('search').'%')
                  ->orwhere('template'  , 'like' , '%'.request('search').'%');
            });
        }
        $templates = $templates->paginate(10);
        if($request->ajax()) {
            $search   = view('new-theme.settings.contract-templates.contract-templates', compact("templates"));
            $paginate = view('new-theme.settings.contract-templates.paginate', compact("templates"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }
        return view('new-theme.settings.contract-templates.index' , compact('templates'));

    }
    public function create(){
        return view('new-theme.settings.contract-templates.create');
    }

    public function edit(ContractTemplate $contract_template){
        return view('new-theme.settings.contract-templates.edit' , compact('contract_template'));
    }

    public function store(Request $request){
       $data = $request -> validate([
            'name' => ['required'  , 'string'],
            'date' => ['required'  , 'string'],
            'template' => ['nullable'  , 'string'],
       ]);
       $data['date'] = Carbon::createFromFormat('m/d/Y' , $data['date'])->format('Y-m-d');
       ContractTemplate::create($data);
       flash()->addSuccess(__('Added successfully'));
       return redirect()->route('contract-templates.index');
    }

    public function update(Request $request , ContractTemplate $contract_template){
        $data = $request -> validate([
             'name' => ['required'  , 'string'],
             'date' => ['required'  , 'string'],
             'template' => ['nullable'  , 'string'],
        ]);
        $data['date'] = Carbon::createFromFormat('m/d/Y' , $data['date'])->format('Y-m-d');
        $contract_template->update($data);
        flash()->addSuccess(__('Updated successfully'));
        return redirect()->route('contract-templates.index');
     }
    public function destroy(ContractTemplate $contract_template){
        $contract_template->delete();
        flash()->addSuccess(__('Deleted successfully'));
        return redirect()->route('contract-templates.index');
    }

    public function print($id){
         $template = ContractTemplate::find($id);
         return view('new-theme.settings.contract-templates.print' , compact('template'));
    }

}

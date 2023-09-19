<?php

namespace App\Http\Controllers;

use App\Models\InsuranceCompany;
use Illuminate\Http\Request;

class InsuranceCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:InsuranceCompanies-List', ['only' => ['index']]);
        $this->middleware('permission:InsuranceCompanies-Create', ['only' => ['create','store']]);
        $this->middleware('permission:InsuranceCompanies-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:InsuranceCompanies-Delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $companies = InsuranceCompany::query()->latest();

        if (request()->ajax()) {
            $companies = $companies
                ->where('name', 'like', '%' . request('search') . '%');

            $search = view('new-theme.settings.insurance-companies.insurance_pagination', [
                'companies' => $companies->get(),
            ]);
            return response()->json(['search' => $search->render()]);
        }

        $companies = $companies->get();

        return view('new-theme.settings.insurance-companies.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('insurance_companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = \Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $company = new InsuranceCompany();
        $company->name      = $request->name;
        $company->created_by      = auth()->user()->creatorId();
        $company->save();
        flash()->addSuccess(__('Added successfully'));
        return redirect()->route("insurance-companies.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $company = InsuranceCompany::find($id);
        return view('insurance_companies.edit' ,compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         //
         $validator = \Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $company = InsuranceCompany::find($id);
        $company->name      = $request->name;
        $company->save();
        return redirect()->route('insurance-companies.index')->with('success', __('Insurance company successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = InsuranceCompany::find($id);
        $company->delete();
        return redirect()->route('insurance-companies.index')->with('success', __('Insurance company successfully deleted.'));
    }
}

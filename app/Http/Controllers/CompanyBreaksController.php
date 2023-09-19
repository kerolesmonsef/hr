<?php

namespace App\Http\Controllers;

use App\Exports\BreakExport;
use App\Models\CompanyBreak;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CompanyBreaksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breaks = CompanyBreak::where('created_by', auth()->user()->creatorId())->get();
        return view('company_breaks.index', compact('breaks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company_breaks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make(
            $request->all(),
            [
                'start_time' => 'required',
                'end_time' => 'required',
            ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $data['start_time'] = Carbon::createFromFormat('H:i', $data['start_time'])->format('h:i a');
        $data['end_time'] = Carbon::createFromFormat('H:i', $data['end_time'])->format('h:i a');
        $data['created_by'] = auth()->user()->creatorId();
        CompanyBreak::create($data);
        return redirect()->route('company-breaks.index')->with(['success' => __('messages.Item was added successfully')]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $break = CompanyBreak::findOrfail($id);
        return view('company_breaks.edit', compact('break'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = \Validator::make(
            $request->all(),
            [
                'start_time' => 'required',
                'end_time' => 'required',
            ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $break = CompanyBreak::findOrfail($id);
        $data['start_time'] = Carbon::createFromFormat('H:i', $data['start_time'])->format('h:i a');
        $data['end_time'] = Carbon::createFromFormat('H:i', $data['end_time'])->format('h:i a');
        $break->update($data);
        return redirect()->route('company-breaks.index')->with(['success' => __('messages.Item was updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $break = CompanyBreak::findOrfail($id);
        $break->delete();
        return redirect()->route('company-breaks.index')->with(['success' => __('messages.Item was deleted successfully')]);
    }


    public function export(Request $request, $employee_id)
    {
        $employee = Employee::findorFail($employee_id);
        return Excel::download(new BreakExport($employee), 'breaks.xlsx');
    }

    public function print($employee_id)
    {
        $employee = Employee::findorFail($employee_id);

        return (new BreakExport($employee))->view();

    }
}

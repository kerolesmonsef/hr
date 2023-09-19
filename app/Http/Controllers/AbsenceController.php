<?php

namespace App\Http\Controllers;

use App\Exports\AbsencesExport;
use App\Models\Employee;
use App\Models\Absence;
use App\Models\AttendanceMovement;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AbsenceController extends Controller
{
    public function absenceCreate($id)
    {
        $employee = Employee::find($id);
        return view('new-theme.payroll.absences.create', compact('employee'));
    }

    public function store(Request $request)
    {
        \request()->validate([
            'employee_id'    => 'required',
            'type'           => 'required',
            'number_of_days' => 'required',
            'start_date'     => 'required',
        ]);

        $attendancemovement  = auth()->user()->CurrentAttendanceMovement();
        $startDate           = \Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $endDate             = Carbon::parse($startDate)->addDays($request->number_of_days)->subDays(1);

        if(!$attendancemovement){
            flash()->addError(__('Please add attendance movement first'));
            return back();
        }

        if($attendancemovement->start_movement_date > $startDate || $attendancemovement->end_movement_date < $startDate)
        {
            flash()->addError(__('The start date must be equal to or greater than the start movement date and the end date is equal to or less than the end movement date'));
            return back();
        }

        $input               = $request->only(['employee_id','type','number_of_days','start_date']);
        $input['start_date'] = $startDate;
        $input['end_date']   = $endDate;
        $input['created_by'] = auth()->user()->creatorId();
        Absence::create($input);

        flash()->addSuccess(__('Added successfully'));
        return redirect()->back();
    }


    public function edit($Absence)
    {
        $Absence    = Absence::find($Absence);
        $leaveTypes = LeaveType::where('created_by' , auth()->user()->creatorId())->whereNotNull('parent')->get();
        if($Absence->created_by == auth()->user()->creatorId())
        {
            return view('new-theme.payroll.absences.edit', compact('Absence','leaveTypes'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, $Absence)
    {
        $Absence = Absence::find($Absence);
        if($Absence->created_by == auth()->user()->creatorId())
        {
            \request()->validate([
                'type'           => 'required',
                'number_of_days' => 'required',
                'start_date'     => 'required',
            ]);

            $attendancemovement  = AttendanceMovement::whereNull('status')->first();
            $startDate           = \Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
            $endDate             = Carbon::parse($startDate)->addDays($request->number_of_days)->subDays(1);

            if($attendancemovement->start_movement_date > $startDate || $attendancemovement->end_movement_date < $startDate)
            {
                flash()->addError(__('The start date must be equal to or greater than the start movement date and the end date is equal to or less than the end movement date'));
                return back();
            }

            $input               = $request->only(['type','number_of_days','start_date']);
            $input['start_date'] = $startDate;
            $input['end_date']   = $endDate;
            $Absence             = $Absence->update($input);

            flash()->addSuccess(__('Updated successfully'));
            return redirect()->back();
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(Absence $Absence)
    {
        if($Absence->created_by == auth()->user()->creatorId())
            {
                $Absence->delete();
                flash()->addSuccess(__('Deleted successfully'));
                return redirect()->back();
            }
            else
            {
                flash()->addError(__('Permission denied'));
                return redirect()->back();
            }
    }

    public function export($id)
    {
        return Excel::download(new AbsencesExport($id), 'absences.xlsx');

    }
}

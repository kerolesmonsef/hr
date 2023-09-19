<?php

namespace App\Http\Controllers;

use App\Services\BreakService;
use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Jobtitle;
use App\Models\Category;
use App\Models\Nationality;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Document;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\AttendanceEmployee;
use App\Models\EmployeeContracts;
use App\Models\EmployeeFollower;
use App\Models\Qualification;
use App\Models\AllowanceOption;
use App\Models\Allowance;
use App\Models\Salary_setting;
use App\Models\Holiday;
use App\Models\Absence;
use App\Models\AttendanceMovement;
use App\Mail\UserCreate;
use App\Models\Plan;
use App\Models\User;
use App\Models\Employee_shift;
use App\Models\Jobtype;
use App\Models\Laborhirecompany;
use App\Models\Workunit;
use App\Models\Bank;
use App\Models\Utility;
use App\Models\Asset;
use App\Models\DucumentUpload;
use App\Models\Leave;
use App\Models\Place;
use App\Models\EmployeeRequest;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Imports\EmployeesImport;
use App\Exports\EmployeesExport;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use Alkoumi\LaravelArabicNumbers\Numbers;
use App\Exports\EmployeeVacationExport;
use App\Helpers\FileHelper;
use App\Http\Resources\CompanyStructureListResource;
use App\Http\Resources\CompanyStructureResource;
use App\Models\CompanyStructure;
use App\Models\ContractTemplate;
use App\Models\DocumentType;
use App\Models\EmployeeBreak;
use App\Models\LeaveType;
use App\Models\Shift;

//use Faker\Provider\File;

class EmployeeController extends Controller
{
    private BreakService $breakService;

    public function __construct()
    {
        // dd(Route::getCurrentRoute()->getActionName());
        $this->breakService = new BreakService();
    }

    public function employee_check_in(Request $request)
    {
        $employee = Employee::with('finger_print_locations')->where('user_id', auth()->id())->first();
        $companySetting = company_setting()->toArray(request());
        $company_grace_period = Utility::getValByName('company_grace_period');
        $startTime = \Carbon\Carbon::parse(Utility::getValByName('company_start_time'))->addMinutes($company_grace_period);
        $in = date("H:i:s", strtotime(date('H:i:s')));

        if ($employee->haveAttendanceToday()) {
            return redirect()->back()->with('success', __('messages.youStartWorkBefore'));
        }

        $distance = get_distance_between_two_points($request->lat, $request->lon, $companySetting['lat'], $companySetting['lon']);
        if ($distance > 1) {
            return redirect()->back()->with('error', __('messages.You are not in the company'));
        }

        if (strtotime($in) > strtotime($startTime)) {
            $totalLateSeconds = strtotime($in) - strtotime($startTime);
            $hours = floor($totalLateSeconds / 3600);
            $mins = floor($totalLateSeconds / 60 % 60);
            $secs = floor($totalLateSeconds % 60);
            $late1 = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
        } else {
            $late1 = "00:00:00";
        }
        $newattandance = AttendanceEmployee::create([
            'employee_id' => $employee->id,
            'status' => 'Present',
            'date' => date('Y-m-d'),
            'clock_in' => date('H:i:s'),
            'lat' => $request->lat,
            'lon' => $request->lon,
            'in_company_range' => 1,
            'late' => $late1,
            'total_rest' => '00:00:00',
            'delay_reason' => '',
            'created_by' => auth()->user()->creatorId(),
            'image_clock_in' => null,
        ]);
        $message = __('messages.startWork');
        return redirect()->back()->with('success', $message);
    }

    public function employee_check_out(Request $request)
    {

        $employee = Employee::with('finger_print_locations')->where('user_id', auth()->id())->first();

        $companySetting = company_setting()->toArray(request());
        $attendance = $employee->haveAttendanceToday();

        $endTime = \Carbon\Carbon::parse(Utility::getValByName('company_end_time'));
        $out = date("H:i:s", strtotime(date('H:i:s')));
        if (!$attendance) {
            return redirect()->back()->with('success', __('messages.notStartWorkToday'));
        }

        if ($attendance && $attendance->clock_out) {
            return redirect()->back()->with('success', __('messages.youEndYourWorkBefore'));
        }


        $distance = get_distance_between_two_points($request->lat, $request->lon, $companySetting['lat'], $companySetting['lon']);
        if ($distance > 1) {
            return redirect()->back()->with('error', __('messages.You are not in the company'));
        }

        if (strtotime($out) < strtotime('8:00')) {
            $totalOvertimeSeconds = strtotime('8:00') - strtotime($out);

            $hours = floor($totalOvertimeSeconds / 3600);
            $mins = floor($totalOvertimeSeconds / 60 % 60);
            $secs = floor($totalOvertimeSeconds % 60);
            $late2 = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
        } else {
            $late2 = "00:00:00";
        }

        $late1 = $attendance ? strtotime($attendance->late) : strtotime("00:00:00");
        $late2 = strtotime($late2);

        $late = \Carbon\Carbon::parse(($late1 + $late2))->format("H:i:s");

        //early Leaving
        $totalEarlyLeavingSeconds = strtotime($endTime) - strtotime($out);
        $hours = floor($totalEarlyLeavingSeconds / 3600);
        $mins = floor($totalEarlyLeavingSeconds / 60 % 60);
        $secs = floor($totalEarlyLeavingSeconds % 60);
        $earlyLeaving = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
        if ($out > strtotime('8:00')) {
            //Overtime
            $totalOvertimeSeconds = strtotime($out) - strtotime('8:00');
            $hours = floor($totalOvertimeSeconds / 3600);
            $mins = floor($totalOvertimeSeconds / 60 % 60);
            $secs = floor($totalOvertimeSeconds % 60);
            $overtime = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
        } else {
            $overtime = '00:00:00';
        }
        if ($attendance) {
            $attendance->update([
                'clock_out' => $out,
                'late' => $late,
                'early_leaving' => ($earlyLeaving > 0) ? $earlyLeaving : '00:00:00',
                'overtime' => $overtime,
                'urgent_end_reason' => $request->urgent_end_reason,
                'image_clock_out' => null,
            ]);
        } else {
            $newattandance = AttendanceEmployee::create([
                'employee_id' => $employee->id,
                'status' => 'Present',
                'date' => date('Y-m-d'),
                'clock_in' => null,
                'clock_out' => $out,
                'lat' => $request['lat'],
                'lon' => $request['lon'],
                'in_company_range' => 1,
                'late' => $late1,
                'total_rest' => '00:00:00',
                'delay_reason' => $request->delay_reason,
                'early_leaving' => ($earlyLeaving > 0) ? $earlyLeaving : '00:00:00',
                'overtime' => $overtime,
                'urgent_end_reason' => $request->urgent_end_reason,
                'created_by' => auth()->user()->creatorId(),
                'image_clock_out' => null,
            ]);
        }
        $message = __('messages.startWork');
        return redirect()->back()->with('success', $message);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_fingerprint_location(Request $request)
    {
        $validator = \Validator::make(
            $request->all(),
            [
                'fingerprint_out_campany' => 'nullable|min:0|max:1',
                'fingerprint_lat' => 'required_if:fingerprint_out_campany,==,1',
                'fingerprint_long' => 'required_if:fingerprint_out_campany,==,1',
                'employee_id' => 'required',
            ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $employee = Employee::where('id', $request->employee_id)->first();

        $data = [
            'fingerprint_out_campany' => $request->fingerprint_out_campany ?? 0,
            'fingerprint_lat' => $request->fingerprint_lat ?? null,
            'fingerprint_long' => $request->fingerprint_long ?? null,
        ];
        $employee->update($data);
        return redirect()->back()->with('success', __('messages.Item was updated successfully'));
    }

    public function terminate(Employee $employee)
    {
        $employee->update([
            'is_active' => $employee->is_active == 0 ? 1 : 0,
        ]);
        $message = $employee->is_active == 0 ? __('Employee terminated successfully.') : __('Employee activated successfully.');
        return redirect()->back()->with('success', $message);
    }

    public function leaves_termination_reciept()
    {
        return view('employee.termination.leaves_termination');
    }

    public function contract_termination_reciept()
    {
        return view('employee.termination.contract_termination');
    }

    public function index(Request $request)
    {
        $employees = Employee::query();
        if (request('search')) {
            $employees = $employees->where(function ($q) {
                $q->where('name_ar', 'like', '%' . request('search') . '%')
                    ->orWhere('name', 'like', '%' . request('search') . '%');
            });
        }
        if (Auth::user()->type == 'employee') {
            $employees = $employees->where('user_id', '=', auth()->id());
        } else {
            //            $employees = $employees->where('created_by', auth()->user()->creatorId());

        }
        $employees = $employees->where('is_active', 1)->paginate(10);

        if ($request->ajax()) {
            $search = view('new-theme.employee.employees', compact("employees"));
            $paginate = view('new-theme.employee.paginate', compact("employees"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }
        return view('new-theme.employee.index', compact('employees'));
    }

    public function create()
    {
        $employee = new Employee();
        $lang = app()->getLocale() == 'ar' ? '_ar' : '';
        $company_settings = Utility::settings();
        $documents = Document::get();
        $branches = Branch::get()->pluck('name' . $lang, 'id');
        $departments = Department::get()->pluck('name' . $lang, 'id');
        $designations = Designation::get()->pluck('name' . $lang, 'id');
        $employees = Employee::get();
        $employeesId = auth()->user()->employeeIdFormat($this->employeeNumber());

        $jobtitles = Jobtitle::get()->pluck('name' . $lang, 'id');
        $categories = Category::get()->pluck('name' . $lang, 'id');
        $nationalities = Nationality::get()->pluck('name' . $lang, 'id');

        $attandance_employees = [];
        $laborCompanies = Laborhirecompany::get()->pluck('name' . $lang, 'id');
        $work_units = Workunit::get()->pluck('name' . $lang, 'id');
        $job_types = Jobtype::get()->pluck('name' . $lang, 'id');
        $jobclasses = ['1', '2'];
        $roles = Role::get()->pluck('name', 'id');
        $allowance_options = AllowanceOption::get()->pluck('name' . $lang, 'id');
        $banks = Bank::get()->pluck('name' . $lang, 'id');
        $employee_shifts = Employee_shift::get();
        $employee_location = Place::get()->pluck('name' . $lang, 'id');

        return view('new-theme.employee.create', compact('employees', 'employee', 'lang', 'roles', 'allowance_options', 'employee_shifts', 'banks', 'laborCompanies', 'jobclasses', 'job_types', 'work_units', 'employeesId', 'departments', 'designations', 'documents', 'branches', 'company_settings', 'jobtitles', 'categories', 'nationalities', 'attandance_employees', 'employee_location'));

    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'name_ar' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);


        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type' => 'employee',
            'lang' => 'en',
            'user_status' => 1,
            'created_by' => auth()->user()->creatorId(),
        ]);

        $data = $request->all();
        $data['nationality_id'] = $request['nationality_type'] == 0 ? $request['nationality_id'] : null;
        $data['driving_license_number'] = $request['driving_license'] == 1 ? $request['driving_license_number'] : null;
        $data['expiry_date'] = $request['driving_license'] == 1 ? $request['expiry_date'] : null;
        $data['dob'] = back_date($request->dob);
        $data['iqama_issuance_date_gregorian'] = back_date($request->iqama_issuance_date_gregorian);
        $data['iqama_issuance_expirydate_gregorian'] = back_date($request->iqama_issuance_expirydate_gregorian);
        $data['user_id'] = $user->id;
        $data['password'] = Hash::make($request['password']);
        $data['employee_id'] = $this->employeeNumber();
        $data['direct_manager'] = $request->direct_manager;
        $data['created_by'] = auth()->user()->creatorId();
        $data['branch_id'] = $request->branch_id;


        if ($request->hasFile('profile')) {
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('profile')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $dir = storage_path('uploads/avatar/');
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $path = $request->file('profile')->storeAs('uploads/avatar/', $fileNameToStore);
        }

        if ($request->hasFile('iqama_attachment')) {
            $filenameWithExt = $request->file('iqama_attachment')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('iqama_attachment')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $dir = storage_path('uploads/document/');
            $image_path = $dir . $filenameWithExt;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $path = $request->file('iqama_attachment')->storeAs('uploads/document/', $fileNameToStore);
            $data['iqama_attachment'] = $fileNameToStore;
        }

        if ($request->hasFile('passport_attachment')) {
            $filenameWithExt = $request->file('passport_attachment')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('passport_attachment')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $dir = storage_path('uploads/document/');
            $image_path = $dir . $filenameWithExt;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $path = $request->file('passport_attachment')->storeAs('uploads/document/', $fileNameToStore);
            $data['passport_attachment'] = $fileNameToStore;
        }

        if ($request->hasFile('insurance_document')) {
            $filenameWithExt = $request->file('insurance_document')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('insurance_document')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $dir = storage_path('uploads/document/');
            $image_path = $dir . $filenameWithExt;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $path = $request->file('insurance_document')->storeAs('uploads/document/', $fileNameToStore);
            $data['insurance_document'] = $fileNameToStore;
        }

        $employee = Employee::create($data);
        $employee->branches()->sync($request->branch_id ?? []);

        return redirect()->route('employee.edit', $employee->id)->with('success', __('Added successfully'));
    }

    public function edit($id)
    {
        $documents = Document::get();
        $branches = Branch::get()->pluck('name', 'id');
        $departments = Department::get()->pluck('name', 'id');
        $designations = Designation::get()->pluck('name', 'id');
        $employees = Employee::where('is_active', 1)->get();
        $employee = Employee::find($id);
        $employeesId = auth()->user()->employeeIdFormat($employee->employee_id);

        $jobtitles = Jobtitle::get()->pluck('name', 'id');
        $categories = Category::get()->pluck('name', 'id');
        $nationalities = Nationality::get()->pluck('name', 'id');
        $employeeContract = EmployeeContracts::where('employee_id', $id)->first();


        $employee_shifts = Employee_shift::get();
        $employee_location = Place::get();

        return view('new-theme.employee.edit', compact('employee', 'employeeContract', 'employees', 'employeesId', 'branches', 'departments', 'designations', 'documents', 'jobtitles', 'categories', 'nationalities', 'employee_shifts', 'employee_location'));

    }

    public function editFinancial(Employee $employee)
    {
        return view('new-theme.employee.editFinancial', compact('employee'));
    }

    public function vacations(Employee $employee)
    {
        return view('new-theme.employee.employeeVacations', compact('employee'));
    }

    public function assets(Employee $employee)
    {
        $assets = $employee->assets;
        return view('new-theme.employee.employeeAssets', compact('employee', 'assets'));
    }

    public function contract(Request $request, Employee $employee)
    {
        if (request('id')) {
            $printtemplate = ContractTemplate::findorfail(request('id'));
            return view('new-theme.employee.contract_template_print', compact('printtemplate'));
        }
        /** @var ContractTemplate $template */
        $template = request('template') ? ContractTemplate::findorfail(request('template')) : ContractTemplate::orderBy('id', 'asc')->first();

        $template = $template ? $template->getTemplateForEmployee($employee) : null;

        if ($request->ajax()) {
            return response()->json(['template' => $template]);
        }

        $templates = ContractTemplate::get();
        return view('new-theme.employee.employeeContract', compact('employee', 'templates', 'template'));
    }

    public function print_contract(Employee $employee)
    {
        $template = request('template') ? ContractTemplate::findorfail(request('template')) : ContractTemplate::orderBy('id', 'asc')->first();
        $template = $template->getTemplateForEmployee($employee);
        return view('new-theme.employee.contract_template_print', compact('template'));
    }

    public function attendance(Employee $employee)
    {
        $requestAjaxDate = request('date');
        $date = $requestAjaxDate ? Carbon::createFromFormat("Y/m", $requestAjaxDate) : null;
        $requestAjaxDateArr = $requestAjaxDate ? explode('/', $requestAjaxDate) : [];

        $dates = [];
        $currentAttendance = AttendanceMovement::query()->where('created_by', '=', auth()->user()->creatorId());

        if ($date) {
            $currentAttendance = $currentAttendance
                ->whereMonth('start_movement_date', $date->month)
                ->whereYear('start_movement_date', $date->year)
                ->first();
        } else {
            $currentAttendance = $currentAttendance->whereNull('status')->first();
        }

        $carbonday = $currentAttendance ? Carbon::parse($currentAttendance->start_movement_date)->format('d') : date('d');
        $carbonmonth = $currentAttendance ? Carbon::parse($currentAttendance->start_movement_date)->format('m') : $requestAjaxDateArr[1];
        $carbonyear = $currentAttendance ? Carbon::parse($currentAttendance->start_movement_date)->format('Y') : $requestAjaxDateArr[0];

        $begin_of_month = now()->setDay($carbonday)->setMonth($carbonmonth)->setYear($carbonyear);
        $end_of_month = $begin_of_month->clone()->addMonthNoOverflow()->subDay();

        for ($i = $begin_of_month; $i <= ($end_of_month); $i->addDay()) {
            $dates[] = $i->format('Y') . '/' . $i->format('m') . '/' . $i->format('d');
        }

        $employeesAttendance = [];
        $totalPresent = $totalLeave = $totalEarlyLeave = $totalVacation = $totalSick = $totalX = 0;
        $ovetimeHours = $overtimeMins = $earlyleaveHours = $earlyleaveMins = $lateHours = $lateMins = 0;
        $employeess = Employee::where('id', $employee->id)->pluck('name', 'id');

        foreach ($employeess as $id => $employeee) {
            $attendances['id'] = $id;
            $attendances['name'] = $employeee;

            foreach ($dates as $date) {
                $dt = Carbon::parse($date);
                $employeeAttendance = AttendanceEmployee::where('employee_id', $id)->where('date', $date)->first();

                if (!empty($employeeAttendance) && $employeeAttendance->status == 'Present') {
                    $attendanceStatus[$date . '-' . $dt->format('l')] = 'P';
                    $totalPresent += 1;

                    if ($employeeAttendance->overtime > 0) {
                        $ovetimeHours += date('h', strtotime($employeeAttendance->overtime));
                        $overtimeMins += date('i', strtotime($employeeAttendance->overtime));
                    }

                    if ($employeeAttendance->early_leaving > 0) {
                        $earlyleaveHours += date('h', strtotime($employeeAttendance->early_leaving));
                        $earlyleaveMins += date('i', strtotime($employeeAttendance->early_leaving));
                    }

                    if ($employeeAttendance->late > 0) {
                        $lateHours += date('h', strtotime($employeeAttendance->late));
                        $lateMins += date('i', strtotime($employeeAttendance->late));
                    }
                } else {
                    $attendanceStatus[$date . '-' . $dt->format('l')] = '';
                }
            }

            $absences = $currentAttendance ? Absence::where('employee_id', $id)->whereBetween('start_date', [$currentAttendance->start_movement_date, $currentAttendance->end_movement_date])->get() : [];
            $absenceStatus = [];

            if ($absences) {
                foreach ($absences as $absence) {
                    $datesArr = [];
                    for ($i = 1; $i <= $absence->number_of_days; $i++) {
                        $startDate = Carbon::parse($absence->start_date);
                        array_push($datesArr, $startDate->addDays($i)->subDays(1)->format('Y/m/d'));

                        foreach ($datesArr as $singleDate) {
                            $singledt = Carbon::parse($singleDate);
                            if ($absence->type == 'A') {
                                $absenceStatus[$singleDate . '-' . $singledt->format('l')] = 'A';
                                $totalLeave += 1;
                            } elseif ($absence->type == 'V') {
                                $absenceStatus[$singleDate . '-' . $singledt->format('l')] = 'V';
                                $totalVacation += 1;
                            } elseif ($absence->type == 'S') {
                                $absenceStatus[$singleDate . '-' . $singledt->format('l')] = 'S';
                                $totalSick += 1;
                            } elseif ($absence->type == 'X') {
                                $absenceStatus[$singleDate . '-' . $singledt->format('l')] = 'X';
                                $totalX += 1;
                            }
                        }
                    }
                }
            }

            $attendances['status'] = array_merge($attendanceStatus, $absenceStatus) ?? [];
            $employeesAttendance[] = $attendances;
        }


        return view('new-theme.employee.employeeAttendance', compact('employee', 'dates', 'employeesAttendance', 'carbonmonth', 'carbonyear'), [
            'employee' => $employee,
            'dates' => $dates,
            'employeesAttendance' => $employeesAttendance,
            'month' => $currentAttendance ? (new Carbon($currentAttendance->start_movement_date))->format("m/Y") : $carbonmonth . '/' . $carbonyear,
            'earlyleaveHours' => $earlyleaveHours,
            'ovetimeHours' => $employee->getEmployeeOverTimes(0, 15) + $employee->getEmployeeOverTimes(16, 30) + $employee->getEmployeeOverTimes(31, 60) + $employee->getEmployeeOverTimes(61, null),
            'totalLeave' => $totalLeave,
            'lateHours' => $employee->getEmployeeDelays(0, 15, $carbonmonth, $carbonyear) + $employee->getEmployeeDelays(16, 30, $carbonmonth, $carbonyear) + $employee->getEmployeeDelays(31, 60, $carbonmonth, $carbonyear) + $employee->getEmployeeDelays(61, null, $carbonmonth, $carbonyear),
            'absencesCount' => isset($absences) ? count($absences) : 0,
        ]);

        return view('new-theme.employee.employeeAttendance', compact('employee'));
    }

    public function editDocuments(Employee $employee)
    {
        $documentTypes = DocumentType::with('documents')->get();
        return view('new-theme.employee.editDocuments', compact('employee', 'documentTypes'));
    }

    public function updateDocuments(Request $request, Employee $employee)
    {
        foreach ($request['files'] as $file) {
            EmployeeDocument::query()->create([
                'document_value' => FileHelper::upload_file('new-theme/images/documents', $file),
                'employee_id' => $employee->id,
                'document_id' => '',
                'document_type_id' => '',
                'document_type_value' => '',
            ]);
        }

        return back()->with('success', 'Updated successfully');
    }

    public function breaks(Employee $employee)
    {
        $breaks = $employee->employee_breaks()
            ->select("employee_breaks.*", DB::raw("TIMEDIFF(start_time, end_time) AS diff"));

        $this->breakService->filter($breaks);

        $breaks = $breaks->paginate(10);

        if (request()->ajax()) {
            $search = view('new-theme.employee.breaks.breaks', compact("breaks"));
            $paginate = view('new-theme.employee.breaks.paginate', compact("breaks"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }
        return view('new-theme.employee.breaks.index', compact('employee', 'breaks'));
    }

    public function update(Request $request, $id)
    {

        /** @var Employee $employee */
        $employee = Employee::findOrFail($id);

        if ($request->has('update_mdeical_insurance')) {
            $exist_companies = implode(',', InsuranceCompany::pluck('id')->toarray());
            $validator = \Validator::make(
                $request->all(),
                [
                    'medical_insurance_number' => 'required',
                    'medical_insurance_card_number' => 'required',
                    'medical_insurance_start_date' => 'required|date',
                    'medical_insurance_end_date' => 'required|date',
                    'medical_blood_type' => 'required|in:O−,O+ ,A−,A+,B−,B+,AB−,AB+',
                    'medical_insurance_type' => 'required|in:private,public',
                    'medical_cover_ratio' => 'required|numeric|min:1|max:100',
                    'medical_insurance_policy' => 'nullable|numeric|min:1|max:1',
                    'insurance_company_id' => 'required|numeric|in:' . $exist_companies,

                ]);

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $input = $request->all();
            if (!$request->medical_insurance_policy) {
                $input['medical_insurance_policy'] = 0;
            }
            $employee->fill($input)->save();
            return redirect()->route('employee.index')->with('success', __('messages.Item was updated successfully'));
        }

        if ($request->has('update_organization_info')) {
            $input = $request->all();
            unset($input['branch_id']);
            $input['direct_manager'] = $input['direct_manager'] == "" ? null : $input['direct_manager'];
            $employee->fill($input)->save();
            $employee->branches()->sync($request->branch_id);
            return redirect()->route('employee.index')->with('success', __('messages.Item was updated successfully'));
        }


        if ($request->has('update_probationDuration')) {
            $employee->employee_on_probation = 1;
            $employee->probation_periods_duration = $request->probation_periods_duration;
            $employee->save();
            return back()->with('success', 'successfully updated.');
        }

        if ($request->has('update_financial_info')) {
            request()->validate([
                'salary' => 'required|numeric|gte:0',
            ]);

            $input = $request->all();
            $input['insurance_startdate'] = back_date($request->insurance_startdate);
            $input['availability_health_insurance_council'] = back_date($request->availability_health_insurance_council);
            $input['medical_insurance_start_date'] = back_date($request->medical_insurance_start_date);
            $input['medical_insurance_end_date'] = back_date($request->medical_insurance_end_date);
            $input['medical_insurance_policy'] = $request->medical_insurance_policy ?? null;
            $employee->fill($input)->save();

            return back()->with('success', __('Updated successfully'));
        }

        request()->validate([
            'name' => 'required',
            'name_ar' => 'required',
            'email' => 'required|unique:employees,email,' . $id,
            'phone' => 'nullable|unique:employees,phone,' . $id,
            'document.*' => 'mimes:jpeg,png,jpg,gif,svg,pdf,doc,zip|max:20480',
        ]);

        if ($request->has("locations")) {
            $employee->syncFingerPrint($request->get("locations"));
        }

        if ($request->document) {
            foreach ($request->document as $key => $document) {
                if (!empty($document)) {
                    $filenameWithExt = $request->file('document')[$key]->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('document')[$key]->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                    $dir = storage_path('uploads/document/');
                    $image_path = $dir . $filenameWithExt;

                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }

                    if (!file_exists($dir)) {
                        mkdir($dir, 0777, true);
                    }
                    $path = $request->file('document')[$key]->storeAs('uploads/document/', $fileNameToStore);


                    $employee_document = EmployeeDocument::where('employee_id', $employee->employee_id)->where('document_id', $key)->first();

                    if (!empty($employee_document)) {
                        $employee_document->document_value = $fileNameToStore;
                        $employee_document->save();
                    } else {
                        $employee_document = new EmployeeDocument();
                        $employee_document->employee_id = $employee->employee_id;
                        $employee_document->document_id = $key;
                        $employee_document->document_value = $fileNameToStore;
                        $employee_document->save();
                    }
                }
            }
        }

        $input = $request->all();

        if ($request->hasFile('iqama_attachment')) {
            $filenameWithExt = $request->file('iqama_attachment')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('iqama_attachment')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $dir = storage_path('uploads/document/');
            $image_path = $dir . $filenameWithExt;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $path = $request->file('iqama_attachment')->storeAs('uploads/document/', $fileNameToStore);
            $data['iqama_attachment'] = $fileNameToStore;
        }

        if ($request->hasFile('passport_attachment')) {
            $filenameWithExt = $request->file('passport_attachment')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('passport_attachment')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $dir = storage_path('uploads/document/');
            $image_path = $dir . $filenameWithExt;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $path = $request->file('passport_attachment')->storeAs('uploads/document/', $fileNameToStore);
            $data['passport_attachment'] = $fileNameToStore;
        }

        if ($request->hasFile('insurance_document')) {
            $filenameWithExt = $request->file('insurance_document')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('insurance_document')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $dir = storage_path('uploads/document/');
            $image_path = $dir . $filenameWithExt;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $path = $request->file('insurance_document')->storeAs('uploads/document/', $fileNameToStore);
            $data['insurance_document'] = $fileNameToStore;
        }

        if ($request->user_register) {
            $employee_user = User::where('id', $employee->user_id)->first();

            if (!$employee_user) {
                $user = User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'type' => 'employee',
                    'lang' => 'en',
                    'user_status' => $request->user_register,
                    'created_by' => auth()->user()->creatorId(),
                ]);

                $user->save();
                $user->assignRole('Employee');
            } else {
                $employee_user->user_status = $request->user_register;
                if ($request->password) {
                    $employee_user->password = Hash::make($request['password']);
                }
                $employee_user->save();
            }

            $input['user_id'] = $employee_user ? $employee_user->id : $user->id;
            if ($request->password) {
                $input['password'] = Hash::make($request['password']);
            }
        }

        $input['nationality_id'] = $request['nationality_type'] == 0 ? $request['nationality_id'] : null;
        $input['driving_license_number'] = $request['driving_license'] == 1 ? $request['driving_license_number'] : null;
        $input['expiry_date'] = $request['driving_license'] == 1 ? $request['expiry_date'] : null;
        $input['dob'] = back_date($request->dob);
        $input['iqama_issuance_date_gregorian'] = back_date($request->iqama_issuance_date_gregorian);
        $input['iqama_issuance_expirydate_gregorian'] = back_date($request->iqama_issuance_expirydate_gregorian);
        $employee->fill($input)->save();
        $employee->user->syncRoles($request->get('role_id'));

        return back()->with('success', 'Updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        if (auth()->user()->can('Delete Employee')) {

            if ($request->has('delete-duration')) {
                $employee = Employee::findOrFail($id);
                $employee->employee_on_probation = null;
                $employee->probation_periods_status = null;
                $employee->probation_periods_duration = null;
                $employee->save();
                return back()->with('success', 'successfully updated.');
            }

            if ($request->has('finish_probationDuration')) {
                $employee = Employee::findOrFail($id);
                $created = Carbon::parse($employee->Join_date_gregorian);
                $now = Carbon::now();
                $employee->probation_periods_status = 1;
                $employee->probation_periods_duration = $created->diff($now)->days;
                $employee->save();
                return back()->with('success', 'successfully updated.');
            }

            $employee = Employee::findOrFail($id);
            $user = User::where('id', '=', $employee->user_id)->first();

            $emp_documents = EmployeeDocument::where('employee_id', $employee->employee_id)->get();
            $employee->delete();
            $user ? $user->delete() : '';

            $dir = storage_path('uploads/document/');
            foreach ($emp_documents as $emp_document) {
                $emp_document->delete();
                if (!empty($emp_document->document_value)) {
                    unlink($dir . $emp_document->document_value);
                }
            }

            return redirect()->route('employee.index')->with('success', 'Employee successfully deleted.');
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show($id)
    {

        $lang = app()->getLocale() == 'ar' ? '_ar' : '';
        $empId = ($id);
        $documents = Document::get();
        $branches = Branch::get()->pluck('name' . $lang, 'id');
        $departments = Department::get()->pluck('name' . $lang, 'id');
        $designations = Designation::get()->pluck('name' . $lang, 'id');
        $employee = Employee::with('finger_print_locations', 'branches', 'jobtitle', 'nationality', 'leaves', 'employee_breaks')->find($empId);
        $leaves_credit = $employee->get_leave_credit()['work_days'];
        $shifts = Shift::where(['employee_id' => $employee->user_id])->with(['place', 'shift_parent'])->get();
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $absences = Absence::where('employee_id', $id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereDate('start_date', '>=', $attendancemovement->start_movement_date)->whereDate('end_date', '<=', $attendancemovement->end_movement_date);
            })->with('leave.leaveType')->get();
        $country = Utility::settings()['country'];
        $currentYearLeaves = $employee->getCurrentYearLeaves();
        $company_settings = Utility::settings();
        $arabiSalary = Numbers::TafqeetMoney($employee->salary, $company_settings['site_currency_symbol']);
        $leaveTypes = LeaveType::whereNotNull('parent')->get();
        //return response($employee);
        $employees = Employee::where([
            'created_by' => auth()->user()->creatorId(),
            'is_active' => 1,
        ])->pluck('name' . $lang, 'id');
        $employeesId = auth()->user()->employeeIdFormat($employee->employee_id);
        $employeeContract = EmployeeContracts::where('employee_id', $empId)->first();
        $employeeFollowers = EmployeeFollower::where('employee_id', $empId)->get();
        $qualifications = Qualification::where('employee_id', $empId)->get();
        //$httpResponse          =  Http::get('https://attendance.our2030vision.com/api/v1/employee/tracking/'.$employee->sync_attendance_employee_id)->json();
        $httpResponse = [];
        $employee_tracking_dates = $httpResponse ? $httpResponse : [];
        $attandance_employees = [];
        $jobtitles = Jobtitle::get()->pluck('name' . $lang, 'id');
        $categories = Category::get()->pluck('name' . $lang, 'id');
        $nationalities = Nationality::get()->pluck('name' . $lang, 'id');
        $laborCompanies = Laborhirecompany::get()->pluck('name' . $lang, 'id');
        $work_units = Workunit::get()->pluck('name' . $lang, 'id');
        $job_types = Jobtype::get()->pluck('name' . $lang, 'id');
        $jobclasses = ['1', '2'];
        $roles = Role::get()->pluck('name', 'id');
        $allowance_options = AllowanceOption::get()->pluck('name' . $lang, 'id');
        $banks = Bank::get()->pluck('name' . $lang, 'id');
        $employee_shifts = Employee_shift::get();
        $assets = Asset::where('employee_id', $empId)->get();
        $documents = DucumentUpload::where('employee_id', $empId)->get();
        $leaves = EmployeeRequest::where('employee_id', '=', $employee->id)->get();
        $employeess = Employee::where('id', $empId)->pluck('name', 'id');
        $insurance_companies = InsuranceCompany::get();
        if (!empty($request->month)) {
            $currentdate = strtotime($request->month);
            $month = date('m', $currentdate);
            $year = date('Y', $currentdate);
            $curMonth = date('M-Y', strtotime($request->month));
        } else {
            $month = date('m');
            $year = date('Y');
            $curMonth = date('M-Y', strtotime($year . '-' . $month));
        }
        $attendanceStatus = [];
        $dates = [];
        $attendancemovement = AttendanceMovement::whereNull('status')->first();

        if ($attendancemovement) {
            $carbonday = \Carbon\Carbon::parse($attendancemovement->start_movement_date)->format('d');
            $carbonmonth = \Carbon\Carbon::parse($attendancemovement->start_movement_date)->format('m');
            $carbonyear = \Carbon\Carbon::parse($attendancemovement->start_movement_date)->format('Y');

            $begin_of_month = now()->setDay($carbonday)->setMonth($carbonmonth)->setYear($carbonyear);
            $end_of_month = $begin_of_month->clone()->addMonthNoOverflow()->subDay();

            for ($i = $begin_of_month; $i <= ($end_of_month); $i->addDay()) {
                $dates[] = $i->format('Y') . '/' . $i->format('m') . '/' . $i->format('d');
            }

        }
        $contract_template = view('employee.contract', compact('employee', 'company_settings', 'arabiSalary'))->render();
        $receipt_of_work_template = view('employee.receiptofwork', compact('employee', 'company_settings'))->render();

        $employeesAttendance = [];
        $totalPresent = $totalLeave = $totalEarlyLeave = $totalVacation = $totalSick = $totalX = 0;
        $ovetimeHours = $overtimeMins = $earlyleaveHours = $earlyleaveMins = $lateHours = $lateMins = 0;

        foreach ($employeess as $id => $employeee) {
            $attendances['id'] = $id;
            $attendances['name'] = $employeee;

            foreach ($dates as $date) {
                $dt = Carbon::parse($date);
                $employeeAttendance = AttendanceEmployee::where('employee_id', $id)->where('date', $date)->first();

                if (!empty($employeeAttendance) && $employeeAttendance->status == 'Present') {
                    $attendanceStatus[$date . '-' . $dt->format('l')] = 'P';
                    $totalPresent += 1;

                    if ($employeeAttendance->overtime > 0) {
                        $ovetimeHours += date('h', strtotime($employeeAttendance->overtime));
                        $overtimeMins += date('i', strtotime($employeeAttendance->overtime));
                    }

                    if ($employeeAttendance->early_leaving > 0) {
                        $earlyleaveHours += date('h', strtotime($employeeAttendance->early_leaving));
                        $earlyleaveMins += date('i', strtotime($employeeAttendance->early_leaving));
                    }

                    if ($employeeAttendance->late > 0) {
                        $lateHours += date('h', strtotime($employeeAttendance->late));
                        $lateMins += date('i', strtotime($employeeAttendance->late));
                    }
                } else {
                    $attendanceStatus[$date . '-' . $dt->format('l')] = '';
                }
            }

            $absences = $attendancemovement ? Absence::where('employee_id', $id)->whereBetween('start_date', [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date])->get() : [];
            $absenceStatus = [];

            if ($absences) {
                foreach ($absences as $absence) {
                    $datesArr = [];
                    for ($i = 1; $i <= $absence->number_of_days; $i++) {
                        $startDate = Carbon::parse($absence->start_date);
                        array_push($datesArr, $startDate->addDays($i)->subDays(1)->format('Y/m/d'));

                        foreach ($datesArr as $singleDate) {
                            $singledt = Carbon::parse($singleDate);
                            if ($absence->type == 'A') {
                                $absenceStatus[$singleDate . '-' . $singledt->format('l')] = 'A';
                                $totalLeave += 1;
                            } elseif ($absence->type == 'V') {
                                $absenceStatus[$singleDate . '-' . $singledt->format('l')] = 'V';
                                $totalVacation += 1;
                            } elseif ($absence->type == 'S') {
                                $absenceStatus[$singleDate . '-' . $singledt->format('l')] = 'S';
                                $totalSick += 1;
                            } elseif ($absence->type == 'X') {
                                $absenceStatus[$singleDate . '-' . $singledt->format('l')] = 'X';
                                $totalX += 1;
                            }
                        }
                    }
                }
            }

            $attendances['status'] = array_merge($attendanceStatus, $absenceStatus) ?? [];
            $employeesAttendance[] = $attendances;
        }

        $totalOverTime = $ovetimeHours + ($overtimeMins / 60);
        $totalEarlyleave = $earlyleaveHours + ($earlyleaveMins / 60);
        $totalLate = $lateHours + ($lateMins / 60);

        $data['totalOvertime'] = $totalOverTime;
        $data['totalEarlyLeave'] = $totalEarlyleave;
        $data['totalLate'] = $totalLate;
        $data['totalPresent'] = $totalPresent;
        $data['totalLeave'] = $totalLeave;
        $data['curMonth'] = $curMonth;

        $setting = Salary_setting::first() ?? [];
        $holidays = Holiday::pluck('date')->toarray();

        $employee_shifts = Employee_shift::get();
        $employee_location = Place::get();

        return view('employee.show', compact('leaves_credit', 'country', 'absences', 'shifts', 'currentYearLeaves', 'leaveTypes', 'employee', 'lang', 'setting', 'holidays', 'employees', 'assets', 'documents', 'employeesAttendance', 'dates', 'data',
            'leaves', 'employee_shifts', 'banks', 'allowance_options', 'roles', 'jobclasses', 'job_types', 'work_units', 'laborCompanies', 'qualifications',
            'jobtitles', 'nationalities', 'categories', 'attandance_employees', 'employeeContract', 'employeeFollowers', 'employeesId', 'branches', 'departments', 'designations',
            'documents', 'employee_tracking_dates', 'receipt_of_work_template', 'contract_template', 'employee_shifts', 'employee_location', 'insurance_companies'));

    }

    function employeeNumber()
    {
        $latest = Employee::query()->latest()->first();
        if (!$latest) {
            return 1;
        }
        return $latest->id + 1;
    }

    // public function export()
    // {
    //     $name = 'employee_' . date('Y-m-d i:h:s');
    //     $data = Excel::download(new EmployeesExport(), $name . '.xlsx');
    //     if (ob_get_contents()) ob_end_clean();

    //     return $data;
    // }

    public function importFile()
    {
        return view('employee.import');
    }

    public function import(Request $request)
    {
        $rules = [
            'file' => 'required|mimes:csv,xlsx,txt',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $employees = (new EmployeesImport())->toArray(request()->file('file'))[0];
        $totalCustomer = count($employees) - 1;
        $errorArray = [];

        for ($i = 1; $i <= count($employees) - 1; $i++) {

            $employee = $employees[$i];
            $employeeByEmail = Employee::where('email', $employee[29])->first();
            $userByEmail = User::where('email', $employee[29])->first();
            // dd($userByEmail);

            if (!empty($employeeByEmail) && !empty($userByEmail)) {
                $employeeData = $employeeByEmail;
            } else {

                $user = new User();
                $user->name = $employee[2] . ' ' . $employee[3] . ' ' . $employee[4];
                $user->email = $employee[29] ?? '';
                $user->password = Hash::make(123456);
                $user->type = 'employee';
                $user->lang = 'en';
                $user->created_by = auth()->user()->creatorId();
                $user->save();
                $user->assignRole('Employee');

                $employeeData = new Employee();
                $employeeData->employee_id = $this->employeeNumber();
                $employeeData->user_id = $user->id;
            }


            $employeeData->name = $employee[2] . ' ' . $employee[3] . ' ' . $employee[4];
            $employeeData->name_ar = $employee[5] . ' ' . $employee[6] . ' ' . $employee[7];
            $employeeData->dob = $employee[10];
            $employeeData->gender = $employee[9] == 'M' ? 'Male' : 'Female';
            $employeeData->phone = $employee[28];
            $employeeData->address = $employee[31];
            $employeeData->email = $employee[29] ?? '';
            $employeeData->password = Hash::make(123456);
            $employeeData->Join_date_gregorian = $employee[12];
            $employeeData->account_holder_name = $employee[1];
            $employeeData->bank_name = $employee[2] . ' ' . $employee[3] . ' ' . $employee[4];
            $employeeData->bank_identifier_code = $employee[34];
            $employeeData->account_number = $employee[36];
            $employeeData->IBAN_number = $employee[37];
            $employeeData->created_by = auth()->user()->creatorId();

            if (empty($employeeData)) {

                $errorArray[] = $employeeData;
            } else {

                $employeeData->save();
            }
        }

        $errorRecord = [];

        if (empty($errorArray)) {
            $data['status'] = 'success';
            $data['msg'] = __('Record successfully imported');
        } else {
            $data['status'] = 'error';
            $data['msg'] = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totalCustomer . ' ' . 'record');


            foreach ($errorArray as $errorData) {

                $errorRecord[] = implode(',', $errorData);
            }

            \Session::put('errorArray', $errorRecord);
        }

        return redirect()->back()->with($data['status'], $data['msg']);
    }

    public function old_import(Request $request)
    {
        $rules = [
            'file' => 'required|mimes:csv,txt',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $employees = (new EmployeesImport())->toArray(request()->file('file'))[0];
        $totalCustomer = count($employees) - 1;
        $errorArray = [];

        for ($i = 1; $i <= count($employees) - 1; $i++) {

            $employee = $employees[$i];
            $employeeByEmail = Employee::where('email', $employee[5])->first();
            $userByEmail = User::where('email', $employee[5])->first();
            // dd($userByEmail);

            if (!empty($employeeByEmail) && !empty($userByEmail)) {

                $employeeData = $employeeByEmail;
            } else {


                $user = new User();
                $user->name = $employee[0];
                $user->email = $employee[5];
                $user->password = Hash::make($employee[6]);
                $user->type = 'employee';
                $user->lang = 'en';
                $user->created_by = auth()->user()->creatorId();
                $user->save();
                $user->assignRole('Employee');

                $employeeData = new Employee();
                $employeeData->employee_id = $this->employeeNumber();
                $employeeData->user_id = $user->id;
            }


            $employeeData->name = $employee[0];
            $employeeData->dob = $employee[1];
            $employeeData->gender = $employee[2];
            $employeeData->phone = $employee[3];
            $employeeData->address = $employee[4];
            $employeeData->email = $employee[5];
            $employeeData->password = Hash::make($employee[6]);
            $employeeData->branch_id = $employee[8];
            $employeeData->department_id = $employee[9];
            $employeeData->designation_id = $employee[10];
            $employeeData->company_doj = $employee[11];
            $employeeData->account_holder_name = $employee[12];
            $employeeData->account_number = $employee[13];
            $employeeData->bank_name = $employee[14];
            $employeeData->bank_identifier_code = $employee[15];
            $employeeData->branch_location = $employee[16];
            $employeeData->tax_payer_id = $employee[17];
            $employeeData->created_by = auth()->user()->creatorId();

            if (empty($employeeData)) {

                $errorArray[] = $employeeData;
            } else {

                $employeeData->save();
            }
        }

        $errorRecord = [];

        if (empty($errorArray)) {
            $data['status'] = 'success';
            $data['msg'] = __('Record successfully imported');
        } else {
            $data['status'] = 'error';
            $data['msg'] = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totalCustomer . ' ' . 'record');


            foreach ($errorArray as $errorData) {

                $errorRecord[] = implode(',', $errorData);
            }

            \Session::put('errorArray', $errorRecord);
        }

        return redirect()->back()->with($data['status'], $data['msg']);
    }

    public function json(Request $request)
    {
        $designations = Designation::where('department_id', $request->department_id)->get()->pluck('name', 'id')->toArray();

        return response()->json($designations);
    }

    public function profile(Request $request)
    {
        if (auth()->user()->can('Manage Employee Profile')) {
            $employees = Employee::where('created_by', auth()->user()->creatorId());
            if (!empty($request->branch)) {
                $employees->where('branch_id', $request->branch);
            }
            if (!empty($request->department)) {
                $employees->where('department_id', $request->department);
            }
            if (!empty($request->designation)) {
                $employees->where('designation_id', $request->designation);
            }
            $employees = $employees->get();

            $brances = Branch::get()->pluck('name', 'id');
            $brances->prepend('All', '');

            $departments = Department::get()->pluck('name', 'id');
            $departments->prepend('All', '');

            $designations = Designation::get()->pluck('name', 'id');
            $designations->prepend('All', '');

            return view('employee.profile', compact('employees', 'departments', 'designations', 'brances'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function profileShow($id)
    {
        if (auth()->user()->can('Show Employee Profile')) {
            $empId = ($id);
            $documents = Document::get();
            $branches = Branch::get()->pluck('name', 'id');
            $departments = Department::get()->pluck('name', 'id');
            $designations = Designation::get()->pluck('name', 'id');
            $employee = Employee::find($empId);
            $employeesId = auth()->user()->employeeIdFormat($employee->employee_id);
            $attandance_employees = [];

            return view('employee.show1', compact('employee', 'employeesId', 'attandance_employees', 'branches', 'departments', 'designations', 'documents'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function lastLogin()
    {
        $users = User::get();
        return view('employee.lastLogin', compact('users'));
    }

    public function employeeJson(Request $request)
    {
        $employees = Employee::where('branch_id', $request->branch)->get()->pluck('name', 'id')->toArray();
        return response()->json($employees);
    }

    public function showtracking($id, $date)
    {
        $employee_tracks = Http::get('https://attendance.our2030vision.com/api/v1/employee/showtracking/' . $id . '/' . $date . '')->json();
        return view('employee.showtracking', compact('employee_tracks'));
    }

    public function addprobation_periods(Request $request, $id)
    {
        $Employeeinfo = Employee::find($id);
        if (auth()->user()->can('Edit Employee')) {
            if ($Employeeinfo->created_by == auth()->user()->creatorId()) {
                return view('probationperiods.edit', compact('Employeeinfo'));
            } else {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    public function vacation_export(Request $request)
    {
        $employee = Employee::findorFail($request->employee) ?? null;
        return Excel::download(new EmployeeVacationExport($employee), 'vacations.xlsx');
    }
}

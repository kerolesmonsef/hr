<?php

namespace App\Http\Controllers;

use App\Exports\LoanRequestExport;
use App\Http\Requests\NewTheme\StoreLoan;
use App\Http\Requests\NewTheme\UpdateLoan;
use App\Models\Employee;
use App\Models\Loan;
use App\Models\LoanOption;
use App\Models\LoanPending;
use App\Services\LoanService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LoanRequestController extends Controller
{
    protected LoanService  $loanService;
    public function __construct()
    {
        $this->middleware('permission:Loan-List', ['only' => ['index']]);
        $this->middleware('permission:Loan-Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Loan-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Loan-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Loan-Export', ['only' => ['export']]);
        $this->middleware('permission:Loan-Print', ['only' => ['print']]);
        $this->loanService = new LoanService();
    }

    public function export()
    {
        return Excel::download(new LoanRequestExport, 'loans.xlsx');
    }

    public function print()
    {
        return (new LoanRequestExport())->view();
    }

    public function index(Request $request)
    {
        $loans = LoanPending::with('employee')->latest();

        $this->loanService->filter($loans);

        $loan_options = LoanOption::all();

        $employees = Employee::where([
            'is_active' => 1,
        ])->get();

        $loans = $loans->paginate(10);

        if ($request->ajax()) {
            $search = view('new-theme.employee.loan.loan', compact("loans", 'employees', 'loan_options'));
            $paginate = view('new-theme.employee.loan.paginate', compact("loans", 'employees', 'loan_options'));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }
        return view('new-theme.employee.loan.index', compact('loans', 'employees', 'loan_options'));
    }

    public function approve($id)
    {

        // //
        // $data['direct_manager'] = auth()->user()->employee->direct_manager;
        // $data['status'] = auth()->user()->employee->direct_manager == null ? 'approved' : 'pending';
        // //
        $loan_request = LoanPending::findOrfail($id);
        $data['status'] = 'approved';
        $loan_request->update([
            //'direct_manager' =>  $data['direct_manager'],
            'status' => $data['status'],
        ]);
        if ($data['status'] == 'approved') {
            $data = [
                'employee_id' => $loan_request->employee_id,
                'loan_option' => $loan_request->loan_option,
                'title' => $loan_request->title,
                'amount' => $loan_request->amount,
                'discount_monthly' => $loan_request->amount / $loan_request->month_nubmer,
                'reason' => $loan_request->reason,
                'start_date' => $loan_request->start_date,
                'month_nubmer' => $loan_request->month_nubmer,
            ];
            $request = new Request($data);
            flash()->addSuccess(__('Approved successfully'));
            app(LoanController::class)->store($request);
        }
    }

    public function reject($id)
    {
        $permission = LoanPending::findorfail($id);
        $permission->update([
            'status' => 'rejected',
            'admin_message' => request('admin_message'),
        ]);
        return redirect()->back()->with(['success' => __('Rejected successfully')]);
    }

    public function create()
    {
        $employees = Employee::where([
            'created_by' => auth()->user()->creatorId(),
            'is_active' => 1,
        ])->get();
        $loan_options = LoanOption::all();
        return view('new-theme.employee.loan.create', compact('employees', 'loan_options'));
    }

    public function loanCreate($id)
    {
        $employee = Employee::find($id);
        $loan_options = LoanOption::get()->pluck('name', 'id');
        return view('loan.create', compact('employee', 'loan_options'));
    }

    public function get_monthly_loan(Request $request)
    {
        $data = $request->all();
        $amount = $data['amount'];
        $month_number = $data['month_number'];

        $discount_monthly = $amount / $month_number;
        $data = [
            'discount_monthly' => $discount_monthly,
            'month_nubmer' => $data['month_number'],
            'amount' => $data['amount'],
        ];
        return $data;
    }

    public function store(StoreLoan $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->user()->creatorId();
        $data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['start_date'])->format('Y-m-d');
        LoanPending::create($data);
        flash()->addSuccess(__('Added successfully'));
        return redirect()->route('loan-requests.index');

    }


    public function update(UpdateLoan $request, $id)
    {
        $data = $request->validated();
        $loan = LoanPending::findorfail($id);
        $data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['start_date'])->format('Y-m-d');
        $loan->update($data);
        flash()->addSuccess(__('Updated successfully'));
        return response()->json();
    }

    public function destroy($id)
    {
        $loan = LoanPending::findorfail($id);
        $loan->delete();
        flash()->addSuccess(__('Deleted successfully'));
        return redirect()->route('loan-requests.index');
    }
}

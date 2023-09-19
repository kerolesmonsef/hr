<?php

namespace App\Http\Controllers\API\V1\Manager;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoanController as ControllersLoanController;
use App\Models\Employee;
use App\Models\EmployeePermission;
use App\Models\Leave;
use App\Models\LoanPending;
use App\Models\Mission;
use App\Models\OverTimeRequest;
use App\Services\Api\LoanService;
use Illuminate\Http\Request;

class LoanController extends Controller
{

    protected LoanService $loanservice;

    public function __construct(LoanService $loanservice)
    {
        $this->loanservice = $loanservice;
    }


    public function accept($id){
        $row = LoanPending::findOrfail($id);
        $direct_manager = Employee::find($row->direct_manager);
        if(auth()->user()->employee->id != $row->direct_manager){
            return $this->error(__('You are not allowed to accept this request'),403,[]);
        }
        if($direct_manager->direct_manager == null){
            $data = [
                'employee_id' => $row->employee_id ,
                'loan_option' => $row->loan_option ,
                'title' => $row->title ,
                'amount' => $row->amount,
                'discount_monthly' =>$row -> amount / $row->month_nubmer ,
                'reason' => $row->reason,
                'start_date' =>  $row->start_date,
                'month_nubmer' => $row -> month_nubmer,
                'loan_pending_id' =>   $row ->id
            ];
            $row->update([
                'direct_manager'=>  $row->direct_manager,
                'status' => 'approved',
            ]);
            $request = new Request($data);
            $this->loanservice->storeLoan($request);
        }
        $row->update([
            'direct_manager'=> $direct_manager->direct_manager == null ? $row->direct_manager :  $direct_manager->direct_manager,
            'status' =>  $direct_manager->direct_manager == null ? 'approved' : 'pending',
        ]);
        return $this->success([] , 'success');
    }

    public function reject(Request $request,$id){
        $data=$request->validate([
            'reason'=>'required',
        ]);
        $row = LoanPending::findOrfail($id);
        if(auth()->user()->employee->id != $row->direct_manager){
            return $this->error(__('You are not allowed to reject this request'),403,[]);
        }
        $row->update([
            'status' => 'rejected',
            'admin_message' => $data['reason'],
        ]);
        return $this->success([] , 'success');
    }

}

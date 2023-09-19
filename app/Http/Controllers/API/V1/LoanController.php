<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreLoan;
use App\Http\Resources\Api\LoanOptionResource;
use App\Http\Resources\LeaveHistoryResource;
use App\Models\Employee;
use App\Models\LoanOption;
use App\Models\LoanPending;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    //
    //
    public function store(StoreLoan $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->user()->creatorId();
        $data['employee_id'] = auth()->user()->employee->id;
        $employee = Employee::findorfail($data['employee_id']);
        LoanPending::create($data);
        $notificationData = [
            'user_id' => auth()->user()->id,
            'type' => 'loan_request',
            'title' => 'loan',
            'title_ar' => 'سلفة',
            'body' => $employee->name . ' request loan',
            'body_ar' => $employee->name_ar . ' قام بطلب سلفة',
            'created_by' => auth()->user()->creatorId(),
            'for_admin' => 1,
            'redirect_url' => route('loan-requests.index'),
        ];
        store_notification($notificationData);
        return $this->success([] , 'success');
    }
    public function index(){
        $loans = LoanPending::where('employee_id', auth()->user()->employee->id)->with('loan_option_item')->latest()->get();
        $loans = $loans->map(function ($item) {
            $item->modeltype = 'loan';
            return $item;
        });
        return $this->success(LeaveHistoryResource::collection($loans), __('Requests'));
    }
    public function get_options()
    {
        $rows = LoanOption::get();
        return $this->success(LoanOptionResource::collection($rows), 'success');
    }
}

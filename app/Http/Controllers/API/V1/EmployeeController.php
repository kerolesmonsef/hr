<?php

namespace App\Http\Controllers\API\V1;

use App\Mail\sendemail;
use App\Models\PaySlip;
use Illuminate\Http\Request;
use Validator;


class EmployeeController extends BaseController
{
    public function salary_recieved()
    {
        $row = PaySlip::where('employee_id', auth()->user()->employee->id)->latest('id')->first();
        if ($row) {
            $row->update([
                'is_recieved' => 1,
            ]);
        }
        return $this->success('', __('messages.data_updated'));
    }


}

<?php

namespace App\Http\Requests;

use App\Models\LeaveType;
use Illuminate\Foundation\Http\FormRequest;

class StoreLeaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $leave_type_ids = implode(',' , LeaveType::where('parent','!=',null)->get()->pluck('id')->toarray());
        return [
            'employee_id'             => ['required'],
            'type'                    => ['required','string','in:leave'],
            'start_date'              => ['required_if:type,==,leave','string'] ,
            'end_date'                => ['required_if:type,==,leave','string'] ,
            'leave_reason'            => ['required_if:type,==,leave','string'] ,
            'leave_type_id'           => ['required_if:type,==,leave','numeric','in:'.$leave_type_ids],
            'replacement_employee_id' => ['nullable' , 'numeric'],
        ];
    }
}

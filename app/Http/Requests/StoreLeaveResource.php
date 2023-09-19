<?php

namespace App\Http\Requests;

use App\Models\LeaveType;
use Illuminate\Foundation\Http\FormRequest;

class StoreLeaveResource extends FormRequest
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
        $leave_type_ids = implode(',' , LeaveType::whereNull('parent')->get()->pluck('id')->toarray());
        return [
            'title' => ['required' , 'string'],
            'title_ar' => ['required' , 'string'],
            'maxDaysPerMonth' => ['nullable' , 'numeric' , 'min:0'],
            'afterMaxHour' => ['nullable' , 'numeric' , 'min:0'],
            'maxDays' => ['nullable' , 'numeric' , 'min:0'],
            'daysBeforeApply' => ['nullable' , 'numeric' , 'min:0'],
            'parent' => ['required' , 'numeric' , 'in:'.$leave_type_ids],
            'deduction' => ['nullable' , 'numeric' , 'min:0'],
        ];
    }
}

<?php

namespace App\Http\Requests\NewTheme;

use App\Models\LeaveType;
use Illuminate\Foundation\Http\FormRequest;

class StoreVacation extends FormRequest
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
            'replacement_employee_id' => ['nullable' , 'numeric' , 'different:employee_id'],
            // 'start_date'              => ['required' ,'date_format:Y-m-d to Y-m-d'] ,
            'start_date'              => ['required' ,'regex:/^\d{4}-\d{2}-\d{2}\s+to\s+\d{4}-\d{2}-\d{2}$/'] ,
            // 'end_date'                => ['required'] ,
            'applied_on'              => ['required'] ,
            'leave_reason'            => ['nullable'] ,
            'leave_type_id'           => ['required','numeric','in:'.$leave_type_ids],
            'status'                  => ['nullable']
        ];
    }
}

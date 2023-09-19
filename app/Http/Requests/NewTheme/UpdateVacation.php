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
            'start_date'              => ['required'] ,
            'end_date'                => ['required'] ,
            'applied_on'                => ['required'] ,
            'leave_reason'            => ['nullable'] ,
            'leave_type_id'           => ['required','numeric','in:'.$leave_type_ids],
            'replacement_employee_id' => ['nullable' , 'numeric'],
        ];
    }
}

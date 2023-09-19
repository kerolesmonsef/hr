<?php

namespace App\Http\Requests\NewTheme;

use App\Models\LeaveType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLoan extends FormRequest
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
        return [
            'title'             => ['required' , 'string'],
            'start_date'        => ['required' , 'string'],
            'amount'            => ['required' , 'string'],
            'month_nubmer'      => ['required' , 'string'],
            'reason'            => ['nullable' , 'string'],
            'status'            => ['required'],
            'employee_id'       => ['required' , 'numeric'],
            'loan_option'       => ['required' , 'numeric'],
        ];
    }
}

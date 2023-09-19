<?php

namespace App\Http\Requests\NewTheme;

use App\Models\LeaveType;
use Illuminate\Foundation\Http\FormRequest;

class PerformanceRequest extends FormRequest
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
            'employee_id'           => ['required'],
            'rate'                  => ['required'],
            'performance_period_id' => ['required'],
            'performance.*.factor'  => ['required'],
            'performance.*.option'  => ['required','in:1,2,3,4,5'],
            'performance.*.notes'   => ['nullable'],

        ];
    }
}

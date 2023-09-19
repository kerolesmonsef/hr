<?php

namespace App\Http\Requests\NewTheme;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends FormRequest
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
        $rules =  [
            // 'department_id'  => 'required',
            'employee_id'       => 'required|array',
            'employee_id.*'     => 'required|exists:employees,id',
            'title'             => 'required|string|max:191',
            'date'              => 'required',
            'time'              => 'required',
            'duration'          => 'required|string',
            'location'          => 'required|string',
            'note'              => 'nullable|string',
        ];


        // if (auth()->user()->type != 'employee') {
        //     $rules = array_merge($rules,[
        //         'branch_id' => 'required|exists:branches,id',
        //     ]);
        // }
        return $rules;
    }
}

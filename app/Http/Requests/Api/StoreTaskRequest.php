<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->employee->isManager() ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|string|max:191',
            'label'             => 'required|string|max:191',
            'start_date'        => 'required|date_format:d/m/Y',
            'due_date'          => 'nullable|date_format:d/m/Y|after_or_equal:start_date',
            'status'            => 'required',
            'employees'         => 'required|array',
            'employees.*'       => 'required|integer|exists:employees,id',
            'note'              => 'nullable|string',
        ];
    }
}

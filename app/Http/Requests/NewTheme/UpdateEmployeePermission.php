<?php

namespace App\Http\Requests\NewTheme;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeePermission extends FormRequest
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
            //
            'employee_id' => 'required|numeric',
            'date' => 'required|string',
            'from' => 'required|string',
            'to' => 'required|string',
            'message' => 'nullable|string',
            'status' => 'nullable|in:approved,pending,rejected',
        ];
    }
}

<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceClockOut extends FormRequest
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
            'lat' => ['required' , 'string'],
            'lon' => ['required' , 'string'],
            'delay_reason' => ['nullable' , 'string'],
            'image' => ['nullable' , 'image' ],
        ];
    }
}

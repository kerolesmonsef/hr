<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name'=> 'required',
            'gender'=> 'required|gender:Male,Female',
            'dob'=> 'required|date',
            'phone'=> 'required',
            'address'=> 'required',
            'email'=> 'required|email',
            'nationality_id'=> 'required',
            'religion'=> 'required:in:0,1,2',
            'social_status'=> 'required:in:0,1',
        ];
    }
}

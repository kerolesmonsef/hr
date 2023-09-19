<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateJobFormRequest extends FormRequest
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
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'age'   => 'required|string',
                'role'  => 'required|string',
                'findus' => 'required|string',
                'interview_day'  => 'required|string',
                'field'  => 'required|array',
                'field.*'  => 'required|string',
                'message'  => 'nullable|string',
                'address' => 'required|string',
                'education' => 'required|string',
                'experience' => 'required|string',
                'linkedin_profile' => 'nullable|url',
                'join_us_date' => 'required|string',
                'salary' => 'required|numeric',
                'english_rate' => 'required|numeric|min:1|max:5',
                'cv' => 'required|file|mimes:pdf,doc,docx',
        ];
    }
}

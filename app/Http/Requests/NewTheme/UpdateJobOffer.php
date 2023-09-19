<?php

namespace App\Http\Requests\NewTheme;

use App\Models\LeaveType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateJobOffer extends FormRequest
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
            'title' => ['required'],
            'job_type' => ['required'],
            'experience' => ['required'],
            'career_level' => ['required'],
            'education_level' => ['required'],
            'salary' => ['required'],
            'job_description' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'form_link' => ['required','url'],
            'company_name' => ['required'],
            'company_location'  => ['required'],
            'company_logo' => ['nullable','image','max:10000'],
        ];
    }
}

<?php

namespace App\Http\Requests\API;

use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreLoan extends FormRequest
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
            'title' => ['required','string'],
            'start_date' => ['required','date','date_format:Y-m-d'] ,
            'amount' => ['required','numeric'] ,
            'month_nubmer' => ['required','numeric'],
            'reason' => ['required' , 'string'],
            'loan_option' => ['required' , 'numeric']
        ];
    }
}

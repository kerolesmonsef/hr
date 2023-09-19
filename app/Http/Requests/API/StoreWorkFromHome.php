<?php

namespace App\Http\Requests\API;

use App\Models\LeaveType;
use Carbon\carbon;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkFromHome extends FormRequest
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
        //dd(Carbon::now()->format('h:i a'));
        return [
            'date' => ['required' , 'string','date_format:Y-m-d'],
            'reason' =>  ['required' , 'string' ],
        ];
    }
}

<?php

namespace App\Http\Requests\Landpage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLandPlan extends FormRequest
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
            'type' => ['required' , 'string','in:regular,lite,pro'],
            'dateType' => ['required' , 'string','in:monthly,yearly'],
            'price' => ['required' , 'numeric' ,'min:1'],
        ];
    }
}

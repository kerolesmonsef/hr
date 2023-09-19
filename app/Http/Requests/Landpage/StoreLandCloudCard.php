<?php

namespace App\Http\Requests\Landpage;

use Illuminate\Foundation\Http\FormRequest;

class StoreLandCloudCard extends FormRequest
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
            'number' => ['required' , 'numeric' , 'min:1' , 'max:100'],
            'descriptionEn' => ['required' , 'string'],
            'descriptionAr' => ['required' , 'string'],
            'image' => ['required' , 'image'],

        ];
    }
}

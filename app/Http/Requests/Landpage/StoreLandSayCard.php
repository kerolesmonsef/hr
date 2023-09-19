<?php

namespace App\Http\Requests\Landpage;

use Illuminate\Foundation\Http\FormRequest;

class StoreLandSayCard extends FormRequest
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
            'name' => ['required' , 'string'],
            'descriptionEn' => ['required' , 'string'],
            'descriptionAr' => ['required' , 'string'],
            'image' => ['required' , 'image'],
            'created_at' => ['required','string'],
        ];
    }
}

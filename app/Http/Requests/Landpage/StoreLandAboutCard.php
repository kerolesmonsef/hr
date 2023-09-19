<?php

namespace App\Http\Requests\Landpage;

use Illuminate\Foundation\Http\FormRequest;

class StoreLandAboutCard  extends FormRequest
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
            'titleEn' => ['required' , 'string'],
            'titleAr' => ['required' , 'string'],
            'descriptionEn' => ['required' , 'string'],
            'descriptionAr' => ['required' , 'string'],
            'image'         => ['required' , 'image'],
        ];
    }
}

<?php

namespace App\Http\Requests\Landpage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLandSocial extends FormRequest
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
            'type' => ['required' , 'in:twitter,facebook,instagram,youtube,googleplus,linkedin'],
            'url' => ['required' , 'url'],
        ];
    }
}

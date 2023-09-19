<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title'         => ['required'],
            'description'   => ['required'],
            'date'          => ['required'],
            'logo'          => ['nullable' , 'image' , 'mimes: png,jpg,jpeg,svg','max:2028'],
            'photo'         => ['nullable' , 'image' , 'mimes: png,jpg,jpeg,svg','max:2028'],
        ];
    }
}

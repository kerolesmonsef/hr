<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name'=> ['required'],
            'offer'=> ['required','min:0'],
            'promocode'=> ['required'],
            'end_date'=> ['required'],
            'description'=> ['nullable'],
            'photo'         => ['nullable' , 'image' , 'mimes: png,jpg,jpeg,svg','max:2028'],
        ];
    }
}

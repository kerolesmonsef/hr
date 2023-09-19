<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApproveLeave extends FormRequest
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
            'deduction' => ['nullable' , 'numeric' , 'min:1'],
            'ticket_flight_status' => ['nullable' , 'string' , 'in:no_both,go,back,go_back'],
            'admin_message' => ['nullable' , 'string' , 'max:100'],
        ];
    }
}

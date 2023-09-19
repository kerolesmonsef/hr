<?php
namespace App\Http\Requests\NewTheme;


use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'title'             => 'required|string|max:191',
            'end_date'          => 'required',
            'start_time'        => 'required',
            'end_time'          => 'required',
            'lectures'          => 'nullable|string|max:191',
            'location'          => 'nullable|string|max:191',
            'about'             => 'nullable|string',
            'photo'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ];
    }
}

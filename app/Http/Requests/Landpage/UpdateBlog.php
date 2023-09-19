<?php

namespace App\Http\Requests\Landpage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlog extends FormRequest
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
            'titleEn' => ['nullable' , 'string'],
            'titleAr' => ['nullable' , 'string'],
            'descriptionEn' => ['nullable' , 'string'],
            'descriptionAr' => ['nullable' , 'string'],
            'image' => ['nullable' , 'image'],
            'metaTitleEn' => ['nullable' , 'string'],
            'metaTitleAr' => ['nullable' , 'string'],
            'metaDescriptionEn' => ['nullable' , 'string'],
            'metaDescriptionAr' => ['nullable' , 'string'],
            'metakeyEn' => ['nullable' , 'string'],
            'metakeyAr' => ['nullable' , 'string'],
            'metaTagEn' => ['nullable' , 'string'],
            'metaTagAr' => ['nullable' , 'string'],
        ];
    }
}

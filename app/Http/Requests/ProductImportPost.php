<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImportPost extends FormRequest
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
            'manifest' => 'required|mimes:xlsx,csv',
            'images' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'manifest.mimes' => 'The :attribute must be a file an Excel or CSV',
        ];
    }
}

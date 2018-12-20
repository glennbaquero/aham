<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationPost extends FormRequest
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
            'address' => 'required',
            'contacts.*' => 'required',
            'emails.*' => 'required|email',
            'latitude' => 'min:0|numeric', 
            'longitude' => 'min:0|numeric', 
        ];
    }

    public function messages()
    {
        return [
            'contacts.*.required' => 'The contact field is required.',
            'emails.*.required' => 'The email address field is required.',
            'emails.*.email' => 'The email address must be a valid email address.',
        ];
    }
}

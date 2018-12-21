<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasicWarrantyRequest extends FormRequest
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
            'serial_number' => 'required',
            'purchase_date' => 'required|date|date_format:Y-m-d',
            'product_id' => 'required',
            'proof_purchase' => 'required|mimes:jpeg,jpg,png'
        ];
    }
}

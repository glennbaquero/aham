<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRepairRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'repair_men_id' => 'required|exists:admins,id',
            'complaint' => 'required',
            'status' => 'required',
            'repair_cost' => 'numeric|min:0',
            'userproducts' => 'required|min:1'
        ];
    }
}

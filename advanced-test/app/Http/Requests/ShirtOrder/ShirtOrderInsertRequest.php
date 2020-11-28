<?php

namespace App\Http\Requests\ShirtOrder;

use Illuminate\Foundation\Http\FormRequest;

class ShirtOrderInsertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|integer',
            'fabric_id' => 'required|integer',
            'collar_size' => 'required|integer',
            'chest_size' => 'required|integer',
            'waist_size' => 'required|integer',
            'wrist_size' => 'required|integer',
        ];
    }
}

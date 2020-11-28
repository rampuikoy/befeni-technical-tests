<?php

namespace App\Http\Requests\ShirtOrder;

use Illuminate\Foundation\Http\FormRequest;

class ShirtOrderUpdateRequest extends FormRequest
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
            'customer_id' => 'integer',
            'fabric_id' => 'integer',
            'collar_size' => 'integer',
            'chest_size' => 'integer',
            'waist_size' => 'integer',
            'wrist_size' => 'integer',
        ];
    }
}

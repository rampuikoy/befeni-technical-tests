<?php

namespace App\Http\Requests\DataSource;

use Illuminate\Foundation\Http\FormRequest;

class DataSourceCreateRequest extends FormRequest
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
            'type' => 'required|in:update,create,delete,receive',
            'method' => 'required|in:post,get,put,patch,delete',
            'url' => 'required|string',
            'tag' => 'required|string',
        ];
    }
}

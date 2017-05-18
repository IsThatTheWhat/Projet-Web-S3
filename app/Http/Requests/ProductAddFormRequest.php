<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddFormRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'price' => 'required|numeric',
            'available' => 'required|numeric',
            'stock' => 'required|numeric',
            'type_id' => 'required|numeric',
            'file' => 'required|sometimes|mimes:jpeg,jpg,svg,png',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'available.numeric' => 'Make sure to choose a field',
            'type_id.numeric' => 'Make sure to choose a field',
        ];
    }
}

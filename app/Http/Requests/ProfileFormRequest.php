<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileFormRequest extends FormRequest
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
            'file' => 'sometimes|mimes:jpeg,jpg,svg,png',
            'name' => 'sometimes|nullable|string|min:3|max:255',
            'lastName' => 'sometimes|nullable|string|min:3|max:255',
            'oldPassword' => 'sometimes|nullable|min:6|max:255',
            'newPassword' => 'sometimes|nullable|required_with:oldPassword|min:6|max:255',
            'address' => 'sometimes|nullable|string|min:5|max:255',
            'email' => [
                'sometimes',
                'nullable',
                'email',
                Rule::unique('users')->ignore(Auth::id()),
            ]
        ];
    }
}

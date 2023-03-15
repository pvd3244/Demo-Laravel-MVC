<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'userName' => 'required|string|min:2',
            'address' => 'required',
            'avatar' => 'nullable|image|mimes:png,jpg,pdf'
        ];
    }

    public function attributes()
    {
        return [
            'userName' => 'tên người dùng',
            'address' => 'địa chỉ',
            'avatar' => 'ảnh đại diện'
        ];

    }
}

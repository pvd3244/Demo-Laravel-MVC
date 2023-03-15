<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RememberTokenRequest extends FormRequest
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
            'reset_password_token' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'reset_password_token' => 'mã xác thực',
        ];
    }
}

<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LoginRequest extends FormRequest
{
    public function rules(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required:0',
        ];


        return $rules;
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Bạn phải nhập tên tài khoản',
            'email.email' => 'Yêu cầu nhập đúng định dạng @gmail, @email,..',
            'password.required' => 'Bạn phải nhập mật khẩu',
        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}
<?php

namespace Modules\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class InfoRequest extends FormRequest
{
    public function rules(Request $request)
    {
        $rules = [
            'introduce' => 'required',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'introduce' => 'Yêu cầu nhập dữ liệu',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
//        $this->merge([
//            'slug' => Str::slug($this->title),
//        ]);
    }
}
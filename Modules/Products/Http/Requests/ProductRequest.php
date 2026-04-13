<?php

namespace Modules\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
{
    public function rules(Request $request)
    {
        $rules = [
            'name'         => 'required|max:255',
            'price'        => 'required|numeric|gt:0',
            'percent_sale' => 'required|numeric|gt:-1',
            'amount'       => 'required|numeric|gt:0',
            'category_id'  => 'required',
            'description'  => 'required',
            'status'       => 'required',
        ];

        if (empty($request->id)) {
            $rules["image"] = "required";
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name'         => 'Yêu cầu nhập dữ liệu',
            'price'        => 'Yêu cầu nhập dữ liệu',
            'percent_sale' => 'Yêu cầu nhập dữ liệu',
            'amount'       => 'Yêu cầu nhập dữ liệu',
            'category_id'  => 'Yêu cầu nhập dữ liệu',
            'description'  => 'Yêu cầu nhập dữ liệu',
            'status'       => 'Yêu cầu nhập dữ liệu',
            'image'        => 'Yêu cầu nhập dữ liệu',
            "price.gt"     => "Số tiền phải lớn hơn 0"
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
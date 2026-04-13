<?php

namespace Modules\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
{
    public function rules(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'blog_category_id' => 'required',
            'short_description' => 'required|min:20|max:255',
            'content' => 'required',
            'status' => 'required',
            'slug' => [Rule::unique('blogs')->ignore($request->id, 'id')],
        ];

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Yêu cầu nhập dữ liệu',
            'book_cate_id.required' => 'Yêu cầu nhập dữ liệu',
            'content.required' => 'Yêu cầu nhập dữ liệu',
            'short_description.required' => 'Yêu cầu nhập dữ liệu',
            'short_description.max' => 'Tối đa 255 kí tự',
            'short_description.min' => 'Nhập tối thiểu 20 kí tự',
            'status.required' => 'Yêu cầu nhập dữ liệu',
            'slug.unique' => 'Blog đã tồn tại! Xin vui lòng nhập tên khác',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
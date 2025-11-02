<?php

namespace App\Http\Requests;

use App\Rules\NoForbiddenWords;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('articles', 'title')->ignore(optional($this->route('article'))->id),
                new NoForbiddenWords,
            ],
            'body' => ['required', 'string', 'min:10'],
            // ảnh: tùy chọn
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được để trống', 'title.unique' => 'Tiêu đề đã tồn tại, vui lòng chọn tiêu đề khác',
            'body.required' => 'Nội dung không được để trống',
            'body.min' => 'Nội dung tối thiểu phải có :min ký tự',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng: jpg, jpeg hoặc png.',
            'image.max' => 'Kích thước ảnh tối đa là :max KB.',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề',
            'body' => 'Nội dung',
            'image' => 'Ảnh minh hoạ',
        ];
    }
}

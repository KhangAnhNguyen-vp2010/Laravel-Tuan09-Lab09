<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'title' => ['required','string','max:255','unique:articles,title'],
            'body' => ['required','string','min:10'],
            'tags' => ['sometimes','nullable','string'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'title.unique' => 'Tiêu đề đã tồn tại, vui lòng chọn tiêu đề khác',
            'body.required' => 'Nội dung không được để trống',
            'body.min' => 'Nội dung tối thiểu phải có :min ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề',
            'body' => 'Nội dung',
        ];
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoForbiddenWords implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $forbidden = ['test', 'spam', 'xxx']; // Danh sách từ cấm
        $lower = mb_strtolower((string) $value, 'UTF-8');

        foreach ($forbidden as $word) {
            if (str_contains($lower, $word)) {
                // Lưu từ vi phạm để hiển thị thông báo
                $this->badWord = $word;
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Trường :attribute chứa từ không được phép: "' . $this->badWord . '".';
    }
}

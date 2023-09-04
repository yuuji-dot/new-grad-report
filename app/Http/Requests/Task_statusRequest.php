<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Task_statusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'progress'=>'required|integer',
            'comment'=>'required',
        ];
    }
    public function messages(): array
    {
        return [
            'progress.required' => '進捗率は必須です。',
            'progress.integer' => '進捗率は数字で入力してください。',
            'comment.required' => 'コメントは必須です。',
        ];
    }
}

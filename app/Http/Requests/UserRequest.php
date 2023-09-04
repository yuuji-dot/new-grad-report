<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                'number' => 'required | max:20',
                'name' => 'required | max:50',
                'password' => ['required', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/', 'max:100'],
                'role' => 'required | max:20',
                'authority' => 'required',
            ];
    }
    public function messages(): array
    {
        return [
            'number.required' => '社員番号は必須です。',
            'number.max' => '社員番号は20文字以内で入力してください。',
            'name.required' => '氏名は必須です。',
            'name.max' => '氏名は50文字以内で入力してください。',
            'password.required' => 'パスワードは必須です。',
            'password.regex' => 'パスワードは大文字、小文字、数字を含む必要があります。',
            'password.max' => 'パスワードは100文字以内で入力してください。',
            'role.required' => '役職は必須です。',
            'role.max' => '役職は20文字以内で入力してください。',
        ];
    }
}

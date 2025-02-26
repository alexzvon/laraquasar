<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:250'],
            'image' => ['nullable', 'file', 'image'],
            'icon' => ['nullable', 'file', 'extensions:svg', 'mimes:svg'],
        ];
    }

    public function message(): array
    {
        return [
            'title.required' => 'Отсутствует наименование',
            'icon.extensions' => 'Не допустимое расширение',
            'icon.mimes' => 'Не правильный тип mimes',
        ];
    }
}

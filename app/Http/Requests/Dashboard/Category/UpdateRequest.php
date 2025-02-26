<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'gt:1'],
            'sort' => ['required', 'integer', 'gt:0'],
            'title' => ['required', 'string', 'max:250'],
            'slug' => ['required', 'string', 'max:250'],
            'picture_image' => ['nullable', 'file', 'image'],
            'picture_icon' => ['nullable', 'file', 'extensions:svg', 'mimes:svg'],
        ];
    }

    public function message(): array
    {
        return [
            'title.required' => 'Отсутствует наименование',
            'slug.required' => 'Отсутствует слаг',
            'sort.required' => 'Отсутствует сортировка',
            'picture_icon.extensions' => 'Не допустимое расширение',
            'picture_icon.mimes' => 'Не правильный тип mimes',
        ];
    }
}

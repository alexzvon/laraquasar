<?php

namespace App\Http\Requests\Dashboard\Characteristic;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [ 'required', 'integer', 'gte:1' ],
            'parent_id' => [ 'required' ],
            'category_id' => [ 'required', 'integer', 'gte:1' ],
            'sort' => [ 'required', 'integer', 'gte:1' ],
            'title' => [ 'required', 'string', 'max:250' ],
            'description' => [ 'string', 'max:250' ],
        ];
    }

    public function message(): array
    {
        return [
            'title.required' => 'Отсутствует наименование',
            'sort.required' => 'Отсутствует сортировка',
        ];
    }
}

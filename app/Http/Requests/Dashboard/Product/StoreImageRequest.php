<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'picture_image' => $this->picture_image ?? [] 
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [ 'required', 'integer', 'gt:0' ],
            'image' => [ 'required', 'file', 'image' ],
            'picture_image' => [ 'nullable', 'array' ],
            'category_id' => [ 'required', 'integer', 'gt:0' ],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Отсутствует id',
            'image.required' => 'Отсутствует image',
            'category_id.required' => 'Отсутствует id категории',
        ];
    }
}

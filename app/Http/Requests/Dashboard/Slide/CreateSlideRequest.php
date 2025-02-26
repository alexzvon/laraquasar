<?php

namespace App\Http\Requests\Dashboard\Slide;

use Illuminate\Foundation\Http\FormRequest;

class CreateSlideRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // dd($this->all());

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
            'name' => [ 'required', 'string', 'max:100' ],
            'href' => [ 'required', 'string', 'max:150' ],
            'picture' => [ 'nullable', 'file', 'image' ],
        ];
    }

    /**
     * Summary of messages
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Отсутствует наименование',
            'href.required' => 'Отсутствует ссылка',
        ];
    }
}

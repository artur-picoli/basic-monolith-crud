<?php

namespace App\Http\Requests;

use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules =  [
            'title' => 'required|max:255',
            'body' => 'required',
            'file' => 'required|mimes:png,jpg,webp|max:10000',
            'categories' => 'required|array',
            'categories.*' => 'required|integer|exists:categories,id'
        ];

        if ($this->method() == 'PUT') {
            data_set($rules, 'file', 'mimes:png,jpg,webp|max:1000');
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'file.required' => 'O campo imagem é obrigatório.',
            'file.mimes' => 'O campo imagem deve conter um arquivo do tipo: :values.',
            'categories.*.exists' => 'O valor selecionado para o campo categorias é inválido.'
        ];
    }
}

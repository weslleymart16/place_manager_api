<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlacesRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:places',
            'city' => 'required',
            'state' => 'required'
        ];

        if ($this->method() == 'PUT') {
            $rules['slug'] = [
                'required',
                'unique:places,slug,'.$this->route('place'),
            ];
        } 

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do lugar é obrigatório.',
            'slug.required' => 'O slug do lugar é obrigatório.',
            'slug.unique' => 'Este slug já está em uso.',
            'city.required' => 'A cidade é obrigatória.',
            'state.required' => 'O estado é obrigatório.',
        ];
    }
}

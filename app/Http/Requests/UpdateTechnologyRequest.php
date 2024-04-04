<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTechnologyRequest extends FormRequest
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
            'name' => ['required', Rule::unique('technologies', 'name')->ignore($this->technology->id), 'max:150'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.unique' => 'Il nome che hai scelto è già stato utilizzato per un altro record',
            'name.max' => 'La lunghezza massima del Nome è di 150 caratteri',
        ];
    }
}

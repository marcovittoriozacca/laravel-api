<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'name' => ['required', 'max:150', Rule::unique('projects', 'name')->ignore($this->route('project')->id)],
            'description' => ['required'],
            'type_id' => ['nullable', 'exists:types,id'],
            'link' => ['nullable'],
            'proj_thumb' => ['nullable', 'file', 'image', 'max:1000', 'mimes:jpg,jpeg,png,svg,webp,bmp,tif,tiff'],
            'technologies' => ['nullable', 'exists:technologies,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il campo Nome è obbligatorio',
            'name.max' => 'La lungezza massima dei caratteri è di 150',
            'name.unique' => 'Questo nome è già stato utilizzato in precedenza',
            'description.required' => 'Il campo Descrizione è obbligatorio',
            'type_id.exists' => 'Questa tipologia non esiste/non è ammessa',
            'technologies.exists' => 'Questa tecnologia non esiste/non è ammessa',
        ];
    }
}

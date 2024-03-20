<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:50',
            'country_id' => 'required|integer|exists:countries,id',
            'requisites' => 'nullable|min:5|max:50',
            'accountant' => 'nullable|min:5|max:50',
            'taxation' => 'nullable|min:5|max:50',
            'description' => 'nullable|min:10|max:100',
            'citi_ids' => 'nullable|integer|array',
            'citi_ids.*' => 'nullable|integer|exists:cities,id',
        ];
    }
}

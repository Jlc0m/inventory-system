<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
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
            'interior_number' => 'required|unique:inventories|min:4|max:100',
            'name' => 'required|min:3|max:30',
            'invoice' => 'min:3|max:50|nullable',
            'delivery_note' => 'min:3|max:50|nullable',
            'user_id' => 'integer|exists:users,id'
        ];
    }
}

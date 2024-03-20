<?php

namespace App\Http\Requests\Inventory\InventoryRelocated;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRelocateRequest extends FormRequest
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
            'inventory_number_to_itams' => 'required|array|exists:inventories,inventory_number_to_itams',

            //sender
            'sender_company_id' => 'required|integer|exists:companies,id',
            'sender_city_id' => 'required|integer|exists:cities,id',
            'sender_office_id' => 'required|integer|exists:offices,id',
            'description' => 'min:5|max:250',

            //recipient
            'recipient_user_id' => 'required|integer|exists:users,id',
            'recipient_company_id' => 'required|integer|exists:companies,id',
            'recipient_city_id' => 'required|integer|exists:cities,id',
            'recipient_office_id' => 'required|integer|exists:offices,id',
        ];
    }
}

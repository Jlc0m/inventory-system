<?php

namespace App\Http\Requests\Inventory\InventoryRelocated;

use Illuminate\Foundation\Http\FormRequest;

class InventoryReceiveRequest extends FormRequest
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

            //recipient
            'recipient_city_id' => 'required|integer|exists:cities,id',
            'recipient_office_id' => 'required|integer|exists:offices,id',
            'recipient_stock_id' => 'required|integer|exists:stocks,id',
            'receive_transaction_id' => 'required|integer|exists:inventory_receive_transactions,id'
        ];
    }
}

<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class ScanInventoryCreateRequest extends FormRequest
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
            'inventory_number_to_itams' => 'required|unique:inventories|array',
            'category_id' => 'required|exists:categories,id|array',

            'company_id' => 'required|integer|exists:companies,id',
            'city_id' => 'required|integer|exists:cities,id',
            'office_id' => 'required|integer|exists:offices,id',
            'stock_id' => 'nullable|integer|exists:stocks,id',
        ];
    }
}

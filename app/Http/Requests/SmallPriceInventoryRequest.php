<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmallPriceInventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'company_id' => 'nullable|integer|exists:companies,id',
            'city_id' => 'nullable|integer|exists:cities,id',
            'office_id' => 'nullable|integer|exists:offices,id',
            'category_small_price_inventory_id' => 'nullable|integer|exists:category_small_price_inventories,id'
        ];
    }
}

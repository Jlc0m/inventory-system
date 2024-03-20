<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class CreateSmallPriceInventoryRequest extends FormRequest
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
            'name' => 'required|array',
            'quantity' => 'required|array',
            'file' => 'required',
            'company_id' => 'required|integer|exists:companies,id',
            'city_id' => 'required|integer|exists:cities,id',
            'office_id' => 'required|integer|exists:offices,id',
            'stock_id' => 'required|integer|exists:stocks,id',
            'category_small_price_inventory_id' => 'required|array'
        ];
    }
}

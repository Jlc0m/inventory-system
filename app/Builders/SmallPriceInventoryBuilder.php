<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class SmallPriceInventoryBuilder extends Builder
{
    public function whereCityId(int $cityId): self
    {
        return $this->where('city_id', $cityId);
    }

    public function whereCompanyId(int $companyId): self
    {
        return $this->where('company_id', $companyId);
    }

    public function whereOfficeId(int $officeId): self
    {
        return $this->where('office_id', $officeId);
    }
    public function whereCategorySmallPriceInventoryId(int $categorySmallPriceInventoryId): self
    {
        return $this->where('category_small_price_inventory_id', $categorySmallPriceInventoryId);
    }

}

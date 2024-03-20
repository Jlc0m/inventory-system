<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class InventoryFilter extends AbstractFilter
{   
    public const NAME = 'name';
    public const INTERIOR_NUMBER = 'interior_number';
    public const COUNTRY_ID = 'country_id';
    public const COMPANY_ID = 'company_id';
    public const CITY_ID = 'city_id';
    public const OFFICE_ID = 'office_id';
    public const STOCK_ID = 'stock_id';
    public const EMPLOYEE_ID = 'employee_id';
    public const CATEGORY_ID = 'category_id';
    public const CONDITION_ID = 'condition_id';

    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::INTERIOR_NUMBER => [$this, 'interior_number'],
            self::COUNTRY_ID => [$this, 'country_id'],
            self::COMPANY_ID => [$this, 'company_id'],
            self::CITY_ID => [$this, 'city_id'],
            self::OFFICE_ID => [$this, 'office_id'],
            self::STOCK_ID => [$this, 'stock_id'],
            self::EMPLOYEE_ID => [$this, 'employee_id'],
            self::CATEGORY_ID => [$this, 'category_id'],
            self::CONDITION_ID => [$this, 'condition_id'],
        ];
    }

    public function name(Builder $builder, $value)
    {
        $builder->where('name', 'like', "%{$value}%");
    }

    public function interior_number(Builder $builder, $value)
    {
        $builder->where('interior_number', $value);

        /* $builder->where('interior_number', 'like', "%{$value}%"); */ //search like interior number
    }

    public function country_id(Builder $builder, $value)
    {
        $builder->where('country_id', $value);
    }

    public function company_id(Builder $builder, $value)
    {
        $builder->where('company_id', $value);
    }

    public function city_id(Builder $builder, $value)
    {
        $builder->where('city_id', $value);
    }

    public function office_id(Builder $builder, $value)
    {
        $builder->where('office_id', $value);
    }

    public function stock_id(Builder $builder, $value)
    {
        $builder->where('stock_id', $value);
    }

    public function employee_id(Builder $builder, $value)
    {
        $builder->where('employee_id', $value);
    }

    public function category_id(Builder $builder, $value)
    {
        $builder->where('category_id', $value);
    }

    public function condition_id(Builder $builder, $value)
    {
        $builder->where('condition_id', $value);
    }
}
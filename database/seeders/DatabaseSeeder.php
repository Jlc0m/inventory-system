<?php

namespace Database\Seeders;

use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Specification\Category;
use App\Models\Specification\Condition;
use App\Models\Specification\Department;
use App\Models\Staff\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'SuperAdmin']);
        Permission::create(['name' => 'edit-interior_number']);
        Permission::create(['name' => 'edit-external_number']);
        Permission::create(['name' => 'edit-name']);
        Permission::create(['name' => 'edit-category']);
        Permission::create(['name' => 'edit-condition']);
        Permission::create(['name' => 'edit-department']);
        Permission::create(['name' => 'edit-country']);
        Permission::create(['name' => 'edit-company']);
        Permission::create(['name' => 'edit-city']);
        Permission::create(['name' => 'edit-office']);
        Permission::create(['name' => 'edit-stock']);
        Permission::create(['name' => 'edit-invoice']);
        Permission::create(['name' => 'edit-delivery_note']);
        Permission::create(['name' => 'edit-inventory']);

        // create roles
        $role = Role::create(['name' => 'SuperAdmin']);
        $role->givePermissionTo('SuperAdmin');

        // assignRole to user
        $user = User::create([
             'name' => 'Dmitry Tortubekov',
             'email' => 'd.tortubekov@gmail.com',
             'password' => Hash::make('14a2b3cc99')
         ]);
        $user->assignRole($role);

        Country::create(['name' => 'Ukraine']);
        Country::create(['name' => 'USA']);

        Condition::create(['name' => 'no distribution']);
        Condition::create(['name' => 'used']);
        Condition::create(['name' => 'in stock']);
        Condition::create(['name' => 'broken']);

        Category::create(['name' => 'furniture']);
        Category::create(['name' => 'tools']);
        Category::create(['name' => 'appliances']);

        Department::create(['name' => 'Supply']);
        Department::create(['name' => 'HR']);
        Department::create(['name' => 'IT']);
        Department::create(['name' => 'Qlab']);

        City::create(['name' => 'Kyiv', 'country_id' => '1']);
        City::create(['name' => 'Kropyvnytskyi', 'country_id' => '1']);
        City::create(['name' => 'Kharkiv', 'country_id' => '1']);
        City::create(['name' => 'Odesa', 'country_id' => '1']);
        City::create(['name' => 'Dnipro', 'country_id' => '1']);
        City::create(['name' => 'Zaporizhzhia', 'country_id' => '1']);
        City::create(['name' => 'Lviv', 'country_id' => '1']);
        City::create(['name' => 'Kryvyi Rih', 'country_id' => '1']);
        City::create(['name' => 'Mykolaiv', 'country_id' => '1']);
        City::create(['name' => 'Khmelnytskyi', 'country_id' => '1']);
        City::create(['name' => 'Poltava', 'country_id' => '1']);
        City::create(['name' => 'Vinnytsia', 'country_id' => '1']);
        City::create(['name' => 'Cherkasy', 'country_id' => '1']);
        City::create(['name' => 'Sumy', 'country_id' => '1']);
        City::create(['name' => 'Ternopil', 'country_id' => '1']);
        City::create(['name' => 'Mukachevo', 'country_id' => '1']);
    }
}

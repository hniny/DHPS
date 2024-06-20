<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'customerOrder-list',
            'customerOrder-create',
            'customerOrder-edit',
            'customerOrder-delete',
            'creditReturn-list',
            'creditReturn-create',
            'creditReturn-edit',
            'creditReturn-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'teamMember-list',
            'teamMember-create',
            'teamMember-edit',
            'teamMember-delete',
            'consigment-list',
            'consigment-create',
            'consigment-edit',
            'consigment-delete',
            'city-list',
            'city-create',
            'city-edit',
            'city-delete',
            'zone-list',
            'zone-create',
            'zone-edit',
            'zone-delete',
            'township-list',
            'township-create',
            'township-edit',
            'township-delete',
            'warehouse_list',
            'department-list',
            'department-create',
            'department-edit',
            'department-delete',
            'position-list',
            'position-create',
            'position-edit',
            'position-delete',
         ];
    
         foreach ($permissions as $permission) {
            try {
                Permission::create(['name' => $permission]);
            } catch (Exception $e) {
                // dd($e);
                Permission::create(['name' => $permission]);
            }
              
         }
    }
}

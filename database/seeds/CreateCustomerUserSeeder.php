<?php

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class CreateCustomerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role = Role::create(['name' => 'Customer']);
      $permissions = Permission::whereIn('name', ['customerOrder-list', 'customerOrder-create', 'customerOrder-edit'])->pluck('id', 'id');
      $role->syncPermissions($permissions);
    }
}

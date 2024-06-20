<?php

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class CreateTeamMemberUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role = Role::create(['name' => 'Team Member']);
      $permissions = Permission::whereIn('name', ['customer-list', 'customer-create', 'customer-edit', 'customerOrder-list', 'customerOrder-create', 'customerOrder-edit'])->pluck('id', 'id');
      $role->syncPermissions($permissions);
    }
}

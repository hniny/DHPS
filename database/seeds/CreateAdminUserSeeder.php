<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = User::create([
      	'name' => 'Admin', 
      	'email' => 'admin@hostmyanmar.net',
      	'password' => bcrypt('internet')
      ]);

      $role = Role::create(['name' => 'Admin']);
  
      $permissions = Permission::where('name', '<>', 'customerOrder-create')->pluck('id','id')->all();

      $role->syncPermissions($permissions);
  
      $user->assignRole([$role->id]);
    }
}

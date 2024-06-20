<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CreateCustomerUserSeeder::class);
        $this->call(CreateTeamMemberUserSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(ReturnReasonTableSeeder::class);
        $this->call(TownShipSeeder::class);
    }
}

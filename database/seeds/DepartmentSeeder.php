<?php

use Illuminate\Database\Seeder;
use App\Department;
class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'Department 1',
            'Department 2',
            'Department 3',
        ];
        foreach ($departments as $key => $department) {
            Department::create([
                'dep_name' => $department
            ]);
        }
    }
}

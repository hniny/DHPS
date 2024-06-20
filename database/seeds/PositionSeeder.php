<?php

use Illuminate\Database\Seeder;
use App\Position;
class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            'Position 1',
            'Position 2',
            'Position 3',
        ];
        foreach ($positions as $key => $position) {
            Position::create([
                'position_name' => $position, 
                'department_id' => '1',
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\ReturnReason;

class ReturnReasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $return_reasons = [
            'Damaged',
            'Expire date less thant 6 months',
            'Different with invoice',
            'Different with order',
         ];
    
         foreach ($return_reasons as $return_reason) {
            ReturnReason::create(['description' => $return_reason]);
         }
    }
}

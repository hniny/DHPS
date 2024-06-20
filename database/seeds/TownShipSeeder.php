<?php

use App\City;
use App\Zone;
use App\TownShip;
use Illuminate\Database\Seeder;

class TownShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $city = City::create(['name' => 'Yangon']);
      $zone = Zone::create(['name' => 'YGN 1', 'city_id' => $city->id]);
      $township = TownShip::create([
        'name' => 'Mingaladon',
        'city_id' => $city->id,
        'zone_id' => $zone->id,
        'postal_code' => '001',
      ]);
    }
}

<?php

use App\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $cities = [
        'Yangon',
        'Bago', 
        'Mandalay',
      ];
      foreach ($cities as $key => $value) {
        City::create([
          'name' => $value,
        ]);
      }
    }
}

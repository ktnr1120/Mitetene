<?php

use Illuminate\Database\Seeder;
use App\Models\Weather;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Weather::create(['name' => '晴れ']);
        Weather::create(['name' => 'くもり']);
        Weather::create(['name' => '雨']);
        Weather::create(['name' => '雪']);
        Weather::create(['name' => '台風']);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Weather::create(['code' => 'sunny', 'name' => '晴れ']);
        Weather::create(['code' => 'cloudy', 'name' => '曇り']);
        Weather::create(['code' => 'rainy', 'name' => '雨']);
        Weather::create(['code' => 'snowy', 'name' => '雪']);
    }
}

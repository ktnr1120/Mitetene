<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use App\Models\Post;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index()
    {
        $weathers = Weather::all();
        return view('weathers.index', compact('weathers'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;

class WeathersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weathers = Weather::all();
        return view('weathers.index', compact('weathers'));
    }

    // 他のアクションも追加する可能性があります
}

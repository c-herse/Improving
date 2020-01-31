<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\Forecast;

class PageController extends Controller
{
    public function index(Request $request){
        $city = $request->get('city')??'Kolding';
        $time = $request->get('time');

        return view('welcome', [
            'data' => Forecast::getWeekForecast($time, $city),
            'city' => $city,
            'time' => $time
        ]);
    }
}

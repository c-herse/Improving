<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PageController extends Controller
{
    public function index(Request $request){
        $city = $request->get('city')??'Kolding';
        $time = $request->get('time');
        $geolocation = $this->getWeekForecast($this->fetchGeolocationData($city), $time);

        return view('welcome', [
            'data' => $geolocation,
            'city' => $city,
            'time' => $time
        ]);
    }

    /**
     * @param string $city
     * @return array
     */
    private function fetchGeolocationData(string $city){
        $flag = true;
        $geolocationData = file_get_contents('http://api.geonames.org/postalCodeSearchJSON?username=raldian&placename='.$city);
        $json = json_decode($geolocationData, true)['postalCodes'];

        // Fallback to Kolding
        if(empty($jon)) {
            $geolocationData = file_get_contents('http://api.geonames.org/postalCodeSearchJSON?username=raldian&placename=kolding');
            $json = json_decode($geolocationData, true)['postalCodes'];
            $flag = false;
        }

        $key = array_search($city, array_column($json, 'placeName'));
        $data = $json[$key];
        $data['status'] = $flag;

        $timezoneData = file_get_contents("http://api.geonames.org/timezoneJSON?lat={$data['lat']}&lng={$data['lng']}&username=raldian");
        $timezoneData = json_decode($timezoneData, true);

        return array_merge($data, $timezoneData);
    }

    /**
     * @param array $geolocation
     * @param string $time
     * @return array
     */
    private function getWeekForecast(array $geolocation, string $time = null){
        $week = [
            'status' => $geolocation['status'],
            'data' => []
        ];
        $timeArray = explode('/', $time);
        $time = isset($time) ? Carbon::createFromDate($timeArray[2], $timeArray[0], $timeArray[1]) : Carbon::now();

        for ($i = 0; $i <= 6; $i++){
            $weekDay = $time->timezone($geolocation['timezoneId'])->startOfWeek()->addDay($i);
            $sunInfo = date_sun_info($weekDay->getTimestamp(), $geolocation['lat'], $geolocation['lng']);

            $week['data'][] = [
                'number' => $weekDay->day,
                'name' => $weekDay->dayName,
                'month' => $weekDay->shortMonthName,
                'sunrise' => date("H:i:s", $sunInfo['sunrise']),
                'sunset' => date('H:i:s', $sunInfo['sunset'])
            ];
        }

        return $week;
    }
}

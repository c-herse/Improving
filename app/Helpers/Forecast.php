<?php
namespace App\Helpers;

use Carbon\Carbon;

class Forecast{

    /**
     * @param string $time
     * @param string $city
     * @return array
     */
    public static function getWeekForecast(string $time = null, string $city = 'kolding'){
        return self::composeWeekForecast(self::fetchGeolocationData($city), $time);
    }

    /**
     * @param string $city
     * @return array
     */
    public static function fetchGeolocationData(string $city){
        $flag = true;
        $geolocationData = file_get_contents('http://api.geonames.org/postalCodeSearchJSON?username='.env('GEONAMES_USERNAME', 'raldian').'&placename='.$city);
        $json = json_decode($geolocationData, true)['postalCodes'];

        // Fallback to Kolding
        if(empty($json)) {
            $geolocationData = file_get_contents('http://api.geonames.org/postalCodeSearchJSON?username='.env('GEONAMES_USERNAME', 'raldian').'&placename=kolding');
            $json = json_decode($geolocationData, true)['postalCodes'];
            $flag = false;
        }

        $key = array_search($city, array_column($json, 'placeName'));
        $data = $json[$key];
        $data['status'] = $flag;

        $timezoneData = file_get_contents("http://api.geonames.org/timezoneJSON?lat={$data['lat']}&lng={$data['lng']}&username=".env('GEONAMES_USERNAME', 'raldian'));
        $timezoneData = json_decode($timezoneData, true);

        return array_merge($data, $timezoneData);
    }

    /**
     * @param array $geolocation
     * @param string $time
     * @return array
     */
    private static function composeWeekForecast(array $geolocation, string $time = null){
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

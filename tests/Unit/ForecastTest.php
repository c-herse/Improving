<?php

namespace Tests\Unit;

use App\Helpers\Forecast;
use PHPUnit\Framework\TestCase;

class ForecastTest extends TestCase
{
    public function testGetWeekForecastWithValidParameters(){
        $forecast = app(Forecast::class);
        $result = $forecast->getWeekForecast('01/31/2020', 'kolding');

        $this->assertEquals(true, $result['status']);
    }

    public function testGetWeekForecastWithInvalidParameters(){
        $forecast = app(Forecast::class);
        $result = $forecast->getWeekForecast(null, 'koldingg');

        $this->assertEquals(false, $result['status']);
    }
}

<?php
    $host = 'https://2829c25d-7bc8-4618-b211-e8ce627254d5:4dfidGfVe1@twcservice.eu-gb.mybluemix.net';

    function getCityLocation($city) {
        $headers = array('Accept' => 'application/json');
        $resource = '/api/weather/v3/location/search?query='. $_POST['city'] . '&locationType=city&language=en-US';
        $result = getData($resource);
        
        $decodedJson = json_decode($result, true);
        $latitude = $decodedJson['location']['latitude'][0];
        $longitude = $decodedJson['location']['longitude'][0];
        
        return array($latitude, $longitude);
    }

    function getWeatherInfoForLocation($location) {
        $longitude = $location[0];
        $latitude = $location[1];

        $result = array();
        $result['forecastLong'] = getForecastLong($longitude, $latitude);
        $result['current'] = getCurrentWeather($longitude, $latitude);
    }

    function getForecastLong($longitude, $latitude) {
        $resource = '/api/weather/v1/geocode/' . $latitude . '/' . $longitude . '/forecast/daily/10day.json?units=m&language=en-US';
        $result = json_decode(getData($resource), true);
    }

    function getCurrentWeather($longitude, $latitude) {
        $resource = '/api/weather/v1/geocode/' . $latitude . '/' . $longitude . '/observations.json?units=m&language=en-US';
        $result = json_decode(getData($resource), true);
    }

    function getData($resource) {
        global $host;

        $headers = array('Accept' => 'application/json');
        $request = Requests::get($host . $resource, $headers, null);
        if ($request->status_code === 200) {
            return $request->body;
        } elseif ($request->status_code === 404) {
            return false;
        } else {
            return null;
        }
    }

    function processForecast($data) {

    }




?>
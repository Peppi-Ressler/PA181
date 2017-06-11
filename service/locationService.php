<?php

    function getCityLocation($city) {
        $headers = array('Accept' => 'application/json');
        $request = Requests::get('https://2829c25d-7bc8-4618-b211-e8ce627254d5:4dfidGfVe1@twcservice.eu-gb.mybluemix.net' .
        '/api/weather/v3/location/search?query='. $_POST['city'] . '&locationType=city&language=en-US', $headers, null);
        if ($request->status_code === 200) {
            $decodedJson = json_decode($request->body, true);
            $latitude = $decodedJson['location']['latitude'][0];
            $longitude = $decodedJson['location']['longitude'][0];
            return array($latitude, $longitude);
        }
    }

    function getForecast48H($location) {
        $longitude = $location[0];
        $latitude = $location[1];
        $headers = array('Accept' => 'application/json');
        $request = Requests::get('https://2829c25d-7bc8-4618-b211-e8ce627254d5:4dfidGfVe1@twcservice.eu-gb.mybluemix.net' .
        '/api/weather/v1/geocode/' . $latitude . '/' . $longitude . '/forecast/daily/10day.json?units=m&language=en-US', $headers, null);
        if ($request->status_code === 200) {
            var_dump($request->body);
        }
    }




?>
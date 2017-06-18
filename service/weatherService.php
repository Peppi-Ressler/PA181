<?php
    // constants
    define("precipitation", "qpf");
    define("temp", "temp");
    define("weekday", "weekday");
    define("humidity", "rh");
    define("pressure", "mslp");
    define("wind", "wspd");
    define("day", "day");
    define("night", "night");
    define("desc", "phrase_32char");

    $host = 'https://2829c25d-7bc8-4618-b211-e8ce627254d5:4dfidGfVe1@twcservice.eu-gb.mybluemix.net';

    function getCityLocation($city) {
        $headers = array('Accept' => 'application/json');
        $resource = '/api/weather/v3/location/search?query='. $_POST['city'] . '&locationType=city&language=en-US';
        $response = makeGetRequest($resource);

        if (!isset($response)) {
            return NULL;
        }
        $decodedJson = json_decode($response, true);

        $latitude = $decodedJson['location']['latitude'][0];
        $longitude = $decodedJson['location']['longitude'][0];
        
        return array($latitude, $longitude);
    }

    function getWeatherInfoForLocation($location) {
        $longitude = $location[0];
        $latitude = $location[1];

        $result = array(); 
        
        $result['current'] = getCurrentWeather($longitude, $latitude);
        $result['forecastLong'] = getForecastLong($longitude, $latitude);
        $result['chart'] = prepareDataForChart($result['forecastLong']);
        return $result;
    }

    function getIconPath($description) {
        if (stripos($description, "snow") !== FALSE) {
            return "snowy.png";
        } elseif (stripos($description, "storm") !== FALSE) {
            return "storm.png";
        } elseif (stripos($description, "rain") !== FALSE || stripos($description, "shower") !== FALSE) {
            return "rainy.png";
        } elseif (stripos($description, "sunny") !== FALSE) {
            return "sunny.png";
        } elseif (stripos($description, "cloudy") !== FALSE) {
            return "cloudy.png";
        } else {
            return "clouds.png";
        }
    }

    function prepareDataForChart($data) {
        $result['cols'] = array(
            array(
                "id" => "",
                "label" => "",
                "pattern" => "",
                "type" => "string"
            ),
            array(
                "id" => "",
                "label" => "",
                "pattern" => "",
                "type" => "number"
            )
        );
        $result['rows'] = array();

        foreach($data as $key => $value) {
            if (!isset($value[day]) || !isset($value[night])) {
                continue;
            }

            $result['rows'][] = 
            array(
                "c" => array(
                    array(
                       "v" => $key,
                        "f" => null  
                    ),
                    array(
                        "v" => $value[day][temp],
                        "f" => null
                    )
                )
            );
        }
        return json_encode($result);
    }

    function getForecastLong($longitude, $latitude) {
        $resource = '/api/weather/v1/geocode/' . $longitude . '/' . $latitude . '/forecast/daily/7day.json?units=m&language=en-US';
        $decodedResponse = json_decode(makeGetRequest($resource), true);
        $dayPhase = day;
        $nightPhase = night;
        $result = array();

        foreach ($decodedResponse['forecasts'] as $day) {
            $date = new DateTime($day['fcst_valid_local']);
            $formattedDate = $date->format('Y-m-d');

            $result[$formattedDate][weekday] = $day['dow'];
            $result[$formattedDate][precipitation] = $day[precipitation];
            $result[$formattedDate]['sunrise'] = date_create_from_format(DATE_ISO8601, $day['sunrise'])->format('H:i');
            $result[$formattedDate]['sunset'] = date_create_from_format(DATE_ISO8601, $day['sunset'])->format('H:i');
            addPhases($day, temp, $formattedDate, $result);
            addPhases($day, humidity, $formattedDate, $result);
            addPhases($day, wind, $formattedDate, $result);
            addPhases($day, desc, $formattedDate, $result);
        }
        return $result;
    }

    function addPhases($day, $key, $formattedDate, &$result) {
        $dayPhase = day;
        $nightPhase = night;
        
        if (isset($day[$dayPhase])) {
            $result[$formattedDate][$dayPhase][$key] = $day[$dayPhase][$key];
        }

        if (isset($day[$nightPhase])) {
            $result[$formattedDate][$nightPhase][$key] = $day[$nightPhase][$key];
        }
    }

    function addValues($hour, $key, $time, &$result) {
        $result[$time][$key] = $hour[$key];
    }

    function getCurrentWeather($longitude, $latitude) {
        $resource = '/api/weather/v1/geocode/' . $longitude . '/' . $latitude . '/forecast/hourly/48hour.json?units=m&language=en-US';
        $decodedResponse = json_decode(makeGetRequest($resource), true);
        $result = array();
        $limit = new ArrayIterator($decodedResponse['forecasts']);

        foreach (new LimitIterator($limit, 0,12) as $hour) {
            $date = new DateTime($hour['fcst_valid_local']);
            $time = $date->format('H:m');

            addValues($hour, temp, $time, $result);
            addValues($hour, precipitation, $time, $result);
            addValues($hour, wind, $time, $result);
            addValues($hour, humidity, $time, $result);
            addValues($hour, desc, $time, $result);
            addValues($hour, pressure, $time, $result);
        }
        return $result;
    }

    function makeGetRequest($resource) {
        global $host;

        $headers = array('Accept' => 'application/json');
        $request = Requests::get($host . $resource, $headers, null);
        //OK
        if ($request->status_code === 200) {
            return $request->body;
        // NOT FOUND
        } elseif ($request->status_code === 404) {
            return false;
        //401,403,500, etc. -> fail state
        } else {
            return null;
        }
    }

?>
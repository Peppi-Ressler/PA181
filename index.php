<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<?php
    include 'service/locationService.php';
    // for loading installed dependencies
    require __DIR__ . '/vendor/autoload.php';

    if (isset($_POST['city'])) {
        $cityLocation = getCityLocation($_POST['city']);
        $weatherInfo = getWeatherInfoForLocation($cityLocation);
        //TODO insert to html
    }
?>

<html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PA181 Weather station</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/app.css">
        <base href="/"/>
    </head>
    <body>

        <h1>Weather</h1>
        <form method="post">
            Desired city:<br>
                <input type="text" name="city"><br>
            <input type="submit" value="Submit">  
        <div>
            <p><?php echo (isset($weatherInfo) ? $weatherInfo : ""); ?></p>
        </div>          
    </body>
</html>

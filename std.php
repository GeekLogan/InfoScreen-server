<?php
    //This is the global variable store
    $STORE_FILE_NAME = 'valueStore.xml';
    $ZIP_CODE = '43210';
    $WEATHER_ADDRESS = "http://weather.yahooapis.com/forecastrss?p=".$ZIP_CODE."&u=f";
    $BUSTIME_KEY = "";
    $BUSTIME_URL = "http://trip.osu.edu/bustime/api/v1/";
    $REQUEST_AUTH_TOKEN = ""; //Add value to require ?auth=xxx for valid requests
    
    if($REQUEST_AUTH_TOKEN != "" && $_GET['auth'] != $REQUEST_AUTH_TOKEN) {
        die("You must authenticate with a propper token to access this server!");
    }
?>

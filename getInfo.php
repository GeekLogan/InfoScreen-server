<?php
    require 'std.php';

    function doBustimeRequest(String $cmd, String $data) {
        require 'std.php';
        $url = $BUSTIME_URL . $cmd . "?key=" . $BUSTIME_KEY . $data;
        $bustimeRaw = file_get_contents($url);
        $bustimeXML = simplexml_load_string($bustimeRaw);
        return $bustimeXML;
    }

    function xmlWrapper($value, $tagName) {
        return '<'.$tagName.'>'.$value.'</'.$tagName.'>';
    }

    $outputString .= file_get_contents($STORE_FILE_NAME);

    //PARSE WEATHER
    $weather_feed = file_get_contents($WEATHER_ADDRESS);
    $weatherXML = simplexml_load_string($weather_feed);
    $channel_yweather = $weatherXML->channel->children("http://xml.weather.yahoo.com/ns/rss/1.0");

    foreach($channel_yweather as $x => $channel_item)
    	foreach($channel_item->attributes() as $k => $attr)
    		$yw_channel[$x][$k] = $attr;

    $item_yweather = $weatherXML->channel->item->children("http://xml.weather.yahoo.com/ns/rss/1.0");
    foreach($item_yweather as $x => $yw_item) {
    	foreach($yw_item->attributes() as $k => $attr) {
    		if($k == 'day') $day = $attr;
    		if($x == 'forecast') { $yw_forecast[$x][$day . ''][$k] = $attr;	}
    		else { $yw_forecast[$x][$k] = $attr; }
    	}
    }

    $weatherTmp = xmlWrapper($yw_forecast['condition']['temp'], 'currentTemp');
    $weatherTmp .= xmlWrapper($yw_forecast['condition']['text'], 'description');
    $i = 0;
    foreach($yw_forecast['forecast'] as $a) {
        if($i == 0) {
            $weatherTmp .= xmlWrapper($a['low'], 'lowTemp');
            $weatherTmp .= xmlWrapper($a['high'], 'highTemp');
        }
        $i++;
    }
    $i = 0;

    $forecastTmp = "";
    foreach($yw_forecast['forecast'] as $a) {
        if($i != 0) {
            $forecastTmp .= xmlWrapper($a['day'], 'day');
            $forecastTmp .= xmlWrapper($a['low'], 'lowTemp');
            $forecastTmp .= xmlWrapper($a['high'], 'highTemp');
            $forecastTmp .= xmlWrapper($a['text'], 'description');
            $forecastTmp = xmlWrapper($forecastTmp, "forecastDay");
        } else {
            $i++;
        }
    }

    $weatherTmp .= xmlWrapper($forecastTmp, 'forecast');
    $outputString .= xmlWrapper($weatherTmp, 'weather');
    //END PARSE WEATHER

    //TODO get/print calendar

    //START BUSTIME FUNCTIONS
    $outputString .= doBustimeRequest("time", "");
    //END BUSTIME FUNCTIONS

    $outputString = xmlWrapper($outputString, "infoScreen");
    $outputString = xmlWrapper($outputString, "wrapper");

    $outputTmp = simplexml_load_string($outputString)
        or die('{"error": "Cannot create object"}');
    $outputFinal = json_encode($outputTmp);

    echo $outputFinal;
?>

<?php
    require 'std.php';
    $outputString = "<wrapper><infoScreen>";

    function doBustimeRequest(String $cmd, String $data) {
        require 'std.php';
        $url = $BUSTIME_URL . $cmd . "?key=" . $BUSTIME_KEY;
        $url .= $data;
        $bustimeRaw = file_get_contents($url);
        $bustimeXML = simplexml_load_string($bustimeRaw);
        return json_encode($bustimeXML);
    }

    function xmlWrapper($a, $tagName) {
        $out = '<'.$tagName.'>';
        $out .= $a;
        $out .= '</'.$tagName.'>';
        return $out;
    }

    $outputString .= file_get_contents($STORE_FILE_NAME);

    //PARSE WEATHER
    $weather_feed = file_get_contents($WEATHER_ADDRESS);
    $weather = simplexml_load_string($weather_feed);
    $channel_yweather = $weather->channel->children("http://xml.weather.yahoo.com/ns/rss/1.0");
    foreach($channel_yweather as $x => $channel_item)
    	foreach($channel_item->attributes() as $k => $attr)
    		$yw_channel[$x][$k] = $attr;
    $item_yweather = $weather->channel->item->children("http://xml.weather.yahoo.com/ns/rss/1.0");
    foreach($item_yweather as $x => $yw_item) {
    	foreach($yw_item->attributes() as $k => $attr) {
    		if($k == 'day') $day = $attr;
    		if($x == 'forecast') { $yw_forecast[$x][$day . ''][$k] = $attr;	}
    		else { $yw_forecast[$x][$k] = $attr; }
    	}
    }

    //var_dump($yw_forecast);
    //echo "\n";

    $outputString .= '<weather>';
    $outputString .= xmlWrapper($yw_forecast['condition']['temp'], 'currentTemp');
    $outputString .= xmlWrapper($yw_forecast['condition']['text'], 'description');
    $i = 0;
    foreach($yw_forecast['forecast'] as $a) {
        if($i == 0) {
            $outputString .= xmlWrapper($a['low'], 'lowTemp');
            $outputString .= xmlWrapper($a['high'], 'highTemp');
        } else {
            $i++;
        }
    }
    $i = 0;
    $outputString .= '<forecast>';
    foreach($yw_forecast['forecast'] as $a) {
        if($i != 0) {
            $outputString .= '<forcastDay>';
            $outputString .= xmlWrapper($a['day'], 'day');
            $outputString .= xmlWrapper($a['low'], 'lowTemp');
            $outputString .= xmlWrapper($a['high'], 'highTemp');
            $outputString .= xmlWrapper($a['text'], 'description');
            $outputString .= '</forcastDay>';
        } else {
            $i++;
        }
    }
    $outputString .= '</forecast>';


    $outputString .= '</weather>';
    //END PARSE WEATHER

    //TODO get/print calendar

    //TODO get/print bus info

    $outputString .= "</infoScreen></wrapper>";

    $outputTmp = simplexml_load_string($outputString)
        or die('{"error": "Cannot create object"}');
    $outputFinal = json_encode($outputTmp);
    //$curStatusArray = json_decode($json,TRUE);

    echo $outputFinal;
?>

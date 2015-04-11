<?php
    require 'std.php';
    $outputString = "<wrapper><infoScreen>";

    //$url = 'http://www.example.com/xml';
    //$in_file = fopen($STORE_FILE_NAME, 'r');
    //while(!feof($in_file)) {
    //    $outputString .= fgets($in_file);
    //}
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

    $outputString .= '<weather>';
    $outputString .= '<currentTemp>';
    $outputString .= $yw_forecast['condition']['temp'];
    $outputString .= '</currentTemp>';
    $outputString .= '<description>';
    $outputString .= $yw_forecast['condition']['text'];
    $outputString .= '</description>';
    $i = 0;
    foreach($yw_forecast['forecast'] as $a) {
        if($i == 0) {
            $outputString .= '<lowTemp>';
            $outputString .= $a['low'];
            $outputString .= '</lowTemp>';
            $outputString .= '<highTemp>';
            $outputString .= $a['high'];
            $outputString .= '</highTemp>';
        }
        $i++;
    }
    $i = 0;
    $outputString .= '<forecast>';
    foreach($yw_forecast['forecast'] as $a) {
        if($i != 0) {
            $outputString .= '<forcastDay>';
            $outputString .= '<day>';
            $outputString .= $a['day'];
            $outputString .= '</day>';
            $outputString .= '<lowTemp>';
            $outputString .= $a['low'];
            $outputString .= '</lowTemp>';
            $outputString .= '<highTemp>';
            $outputString .= $a['high'];
            $outputString .= '</highTemp>';
            $outputString .= '<description>';
            $outputString .= $a['text'];
            $outputString .= '</description>';
            $outputString .= '</forcastDay>';
        }
        $i++;
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

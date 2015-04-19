<?

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
            if($x == 'forecast') { $yw_forecast[$x][$day . ''][$k] = $attr; }
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
        $lineTmp = xmlWrapper($a['day'], 'day');
        $lineTmp .= xmlWrapper($a['low'], 'lowTemp');
        $lineTmp .= xmlWrapper($a['high'], 'highTemp');
        $lineTmp .= xmlWrapper($a['text'], 'description');
        $lineTmp = xmlWrapper($lineTmp, "forecastDay");
        $forecastTmp .= $lineTmp;
    } else {
        $i++;
    }
}

$weatherTmp .= xmlWrapper($forecastTmp, 'forecast');
$outputString .= xmlWrapper($weatherTmp, 'weather');

?>

<?php
    require 'std.php';

    function xmlWrapper($value, $tagName) {
        return '<'.$tagName.'>'.$value.'</'.$tagName.'>';
    }

    $outputString = file_get_contents($STORE_FILE_NAME);
    $outputString = str_replace('<?xml version="1.0"?>', "", $outputString);

    include 'modules/weather.php';
    include 'modules/bustime.php';

    $outputString = xmlWrapper($outputString, "infoScreen");
    $outputString = xmlWrapper($outputString, "wrapper"); //removed by JSON

    $outputTmp = simplexml_load_string($outputString) or die('{"error": "Cannot create object"}');
    $outputFinal = json_encode($outputTmp);

    echo $outputFinal;
    //echo $outputString;
    echo "\n";
?>

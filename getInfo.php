<?php
    require 'std.php';

    function xmlWrapper($value, $tagName) {
        return '<'.$tagName.'>'.$value.'</'.$tagName.'>';
    }

    $outputString = file_get_contents($STORE_FILE_NAME);
    $outputString = str_replace('<?xml version="1.0"?>', "", $outputString);

    //START WEATHER
    include 'modules/weather.php';
    //END WEATHER

    //@TODO get/print calendar

    //START BUSTIME NOTE: Bustime Spanning Tree Search has Been Removed to Save Time
    include 'modules/bustime.php';
    //END BUSTIME

    $outputString = xmlWrapper($outputString, "infoScreen");
    $outputString = xmlWrapper($outputString, "wrapper");
    //The "wrapper" is stripped off by the JSON compiler

    $outputTmp = simplexml_load_string($outputString) or die('{"error": "Cannot create object"}');
    $outputFinal = json_encode($outputTmp);

    echo $outputFinal;
    //echo $outputString;
    echo "\n";
?>

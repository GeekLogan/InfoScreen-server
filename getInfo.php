<?php
    function getXMLText()
    {
        require 'std.php'; //load scope vars
        $out_str = "";
        //$url = 'http://www.example.com/xml';
        $in_file = fopen($STORE_FILE_NAME, 'r');
        while(!feof($in_file)) {
            $out_str .= fgets($in_file);
        }
        return $out_str;
    }

    $outputString = "<wrapper><infoScreen>";
    $outputString = $outputString . getXMLText();
    //$curStatusArray = json_decode($json,TRUE);

    //TODO get/print weather

    //TODO get/print calendar

    //TODO get/print bus info

    $outputString = $outputString . "</infoScreen></wrapper>";

    $outputTmp = simplexml_load_string($outputString)
        or die('{"error": "Cannot create object"}');
    $outputFinal = json_encode($outputTmp);

    echo $outputFinal;
?>

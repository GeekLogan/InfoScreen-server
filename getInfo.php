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

    $curStatusXML = simplexml_load_string(getXMLText())
        or die('{"error": "Cannot create object"}');
    $curStatus = json_encode($curStatusXML);
    //$curStatusArray = json_decode($json,TRUE);

    echo $curStatus;

    //TODO get/print weather

    //TODO get/print calendar

    //TODO get/print bus info
?>

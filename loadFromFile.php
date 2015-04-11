<?php
    require 'std.php';

    function getXML()
    {
        $out_str = "";
        $i = 0;
        //$url = 'http://www.example.com/xml';

        $in_file = fopen($STORE_FILE_NAME, 'r');
        while(!feof($in_file)) {
                if($i != 0) {
                        $out_str .= fgets($in_file);
                } else {
                        fgets($in_file);
                }
                $i++;
        }
        return $out_str;
    }

    //$curStatusXML_string = getXML();
    //$curStatusXML = simplexml_load_string($curStatusXML_string) or die('{"error": "Cannot create object"}');
    //$curStatus = json_encode($xml);
    //$curStatusArray = json_decode($json,TRUE);
?>

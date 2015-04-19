<?

function doBustimeRequest($cmd, $data) {
    require 'std.php';
    $url = $BUSTIME_URL . $cmd . "?key=" . $BUSTIME_KEY . $data;
    $bustimeRaw = file_get_contents($url);
    $bustimeXML = simplexml_load_string($bustimeRaw);
    return $bustimeXML;
}

$settings = simplexml_load_string(file_get_contents($STORE_FILE_NAME));
$requestedStopId = $settings->defaultStop . "";
        $predictionLine .= xmlWrapper($a->vid, "vid");

if(!empty($_GET['stpid'])) $requestedStopId = $_GET['stpid'];

$predictionTmp = "";
if(strcmp($requestedStopId, "") != 0) {
    $predictionXML = doBustimeRequest("getpredictions", "&stpid=" . $requestedStopId);
    foreach($predictionXML->prd as $a) {
        $predictionLine = xmlWrapper($a->prdtm, "time");
        $predictionLine .= xmlWrapper($a->rt, "route");
        $predictionLine .= xmlWrapper($a->stpid, "stop");
        $predictionLine .= xmlWrapper($a->rtdir, "direction");
        $predictionLine .= xmlWrapper($a->vid, "vid");
        $predictionTmp .= xmlWrapper($predictionLine, "predictionUnit");
    }
}
$outputString .= xmlWrapper($predictionTmp, "prediction");

?>

<?php

$iCalCmd = "python modules/calendar/iCalRunner.py";
$bufferFile = "modules/calendar/calendar_buffer.txt";

$cal = "";
if(file_exists($bufferFile)) {
    $cal = file_get_contents($bufferFile);
}
$outputString .= xmlWrapper($cal, "calendar");

$cmd = 'bash -c "(nohup '. $iCalCmd . ' && exec nohup mv '.$bufferFile.'1 ';
$cmd .= $bufferFile.') > ' . $bufferFile . '1 2>&1 &"';
exec($cmd);

?>

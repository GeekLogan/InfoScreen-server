<?

#$calendarTmp = "";

$command = escapeshellcmd('python calendar/iCalRunner.py');
$output = shell_exec($command);
echo $output;

#$outputString .= xmlWrapper($predictionTmp, "calendar");

?>

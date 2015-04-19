<?

$command = escapeshellcmd('python calendar/iCalRunner.py');
$calendarTmp = shell_exec($command);
outputString .= xmlWrapper($calendarTmp, "calendar");

?>

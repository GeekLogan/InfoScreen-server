<?

$command = escapeshellcmd('python modules/calendar/iCalRunner.py');
$calendarTmp = shell_exec($command);
$outputString .= xmlWrapper($calendarTmp, "calendar");

?>

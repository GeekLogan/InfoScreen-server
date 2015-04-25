<?php

$command = escapeshellcmd('python modules/calendar/iCalRunner.py');
$calendarTmp = shell_exec($command);
$myfile = fopen("modules/calendar/calendar_buffer.txt", "w");
fwrite($myfile, $calendarTmp);

?>

<?php
$output = shell_exec('sudo /etc/init.d/apache2 stop');
echo "<pre>$output</pre>";
?>
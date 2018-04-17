<?php
$update = shell_exec("sudo /etc/init.d/apache2 stop");
echo $update;
?>
<?php
try
{
$db = new PDO('mysql:host=localhost; dbname=ludaweb01', 'ludaweb01', 'Pyjama11112kNZ1!@', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));}
catch (Exception $e)
{
        die('' . $e->getMessage());
}
?>

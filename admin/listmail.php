<?php
session_start();
include("../includes/identifiants.php");
include("../includes/debut.php");

$query = $db->prepare('SELECT membre_email FROM forum_membres');
$query->execute();
while ($data=$query->fetch()) {
	echo' '.$data['membre_email'].',';
}
?>
<?php
session_start();
include("includes/identifiants.php");

$query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$_SESSION['id'].'');
$query->execute() or die(print_r($query->errorInfo())); 
$data = $query->fetch();
$theme_odyssey = $data['theme_odyssey'];
if ($theme_odyssey==1) {
$expire = time() + 365*24*3600;
setcookie('design', '4', $expire);
header("Status: 301 Moved Permanently", false, 301);
header("Location: /changedesign.html");
}
?>
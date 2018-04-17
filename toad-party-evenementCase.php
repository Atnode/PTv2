<?php
session_start();
include("./includes/identifiants.php");
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html'); 
$diceRequete = $db->prepare('SELECT * FROM toadparty_evenementCase ORDER BY id DESC LIMIT 1');
$diceRequete->execute() or die(print_r($diceRequete->errorInfo()));
$data = $diceRequete->fetch();

echo'<div style="background:url(\''.$data['image'].'\');background-position:center;background-repeat:no-repeat;"><br><br><br><br><br><br><br><br><br><br><br><br><br><div style="text-align:center;">'.$data['evenementCase'].'</div></div>';

?>
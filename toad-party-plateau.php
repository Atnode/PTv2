<?php
session_start();
include("./includes/identifiants.php");
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html'); 

$diceRequete = $db->prepare('SELECT * FROM toadparty_stats LEFT JOIN toadparty_cases ON toadparty_cases.id = toadparty_stats.id_case WHERE id_joueur = '.$id.'');
$diceRequete->execute() or die(print_r($diceRequete->errorInfo()));
echo'<div style="background:url(\'/images/toadparty/plateau.png\');height:64px;background-repeat:no-repeat;">';
$dice = $diceRequete->fetch();

$persoReq = $db->prepare('SELECT * FROM toadparty_participants LEFT JOIN toadparty_personnages ON toadparty_personnages.id = toadparty_participants.id_perso WHERE id_joueur = '.$id.'');
$persoReq->execute() or die(print_r($persoReq->errorInfo()));
$perso = $persoReq->fetch();
echo'<div style="'.$dice['style'].'"><img src="'.$perso['sprite'].'" /></div>';

echo'</div>';
?>
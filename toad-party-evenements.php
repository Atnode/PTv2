<?php
session_start();
include("./includes/identifiants.php");
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html'); 
echo'<h2>Evenements récents</h2><br><br>';
$diceRequete = $db->prepare('SELECT * FROM toadparty_evenements ORDER BY id DESC LIMIT 12');
$diceRequete->execute() or die(print_r($diceRequete->errorInfo()));
while ($data = $diceRequete->fetch()) {

echo'<i style="color:grey;">['.date('H:i:s',$data['time']).']</i> '.$data['evenement'].'<br><br>';
}
?>
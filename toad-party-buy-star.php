<?php
session_start();
include("./includes/identifiants.php");
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html'); 
$diceRequete = $db->prepare('SELECT * FROM toadparty_etoiles WHERE id_joueur = '.$id.'');
$diceRequete->execute() or die(print_r($diceRequete->errorInfo()));
if ($diceRequete->rowCount()>0) {
$data = $diceRequete->fetch();

if ($_GET['id']=="0" AND $data['done']=="0") { // On lui propose d'acheter
   $query = $db->prepare('UPDATE toadparty_stats SET nombre_etoiles = nombre_etoiles + 1, nombre_pieces = nombre_pieces - 20 WHERE id_joueur = '.$id.'');
   $query->execute();

   // On fait un évènement
   $reqPerso = $db->prepare('SELECT * FROM toadparty_personnages LEFT JOIN toadparty_participants ON toadparty_participants.id_perso = toadparty_personnages.id WHERE id_joueur = '.$id.'');
   $reqPerso->execute();
   $perso = $reqPerso->fetch();
   $evenement = "<b><span style=\"color:".$perso['color_perso'].";\">".$perso['name_perso']."</span></b> a acheté <b>1 Etoile</b>.";

   $evenReq = $db->prepare('INSERT INTO toadparty_evenements (evenement, time) VALUES(:evenement, :time)');
   $evenReq->bindValue(':evenement', $evenement, PDO::PARAM_STR);
   $evenReq->bindValue(':time', time(), PDO::PARAM_INT);
   $evenReq->execute();

   // On delete la possibilité d'acheter des étoiles
   $deleteStar = $db->prepare('DELETE FROM toadparty_etoiles WHERE id_joueur = '.$id.'');
   $deleteStar->execute();
} elseif ($_GET['id']=="1") {
   // On delete la possibilité d'acheter des étoiles
   $deleteStar = $db->prepare('DELETE FROM toadparty_etoiles WHERE id_joueur = '.$id.'');
   $deleteStar->execute();
}
}
?>
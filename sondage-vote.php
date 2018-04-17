<?php
session_start();
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html');
$titre = "Planète Toad &bull; Sondage vote";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
echo'<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> Sondage</div><br />';
if (isset($_POST['vote']))
{
	$vote = ($_POST['vote']);
	$affiche = $db->prepare('SELECT * FROM sondage_vote WHERE id_membre = '.$id.'');
	$affiche->execute();
	if ($affiche->rowCount()<1) {
    $query = $db->prepare('INSERT INTO sondage_vote(id_membre,value) VALUES(:id,:value)');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->bindValue(':value',$vote,PDO::PARAM_INT);
	$query->execute();
	echo'<p align=center>Votre vote a été pris en compte. <a href="/">Cliquez ici pour retourner à l\'accueil.</a></p>'; } 
	else {echo'<p align=center>Vous avez déjà voté.</p>';}
} else {echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://www.planete-toad.fr">';}
include("includes/fin.php");
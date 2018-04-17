<?php
session_start();
$titre="Planète Toad &bull; Modération";
$balises = true;
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
include("../includes/menu.php");
echo'<h1>Avertissements</h1>';
$action = isset($_GET['action'])?htmlspecialchars($_GET['action']):'';
switch($action)
{
case "add":
if (isset($_GET['id'])) // Si l'on demande de supprimer une news.
{
    // Alors on supprime la news correspondante.
    // On protège la variable « id_news » pour éviter une faille SQL.
    $_GET['id'] = ($_GET['id']);
    $retour = $db->prepare('UPDATE forum_membres SET avertissement = avertissement +1  WHERE membre_id=\'' . $_GET['id'] . '\'');
	$retour->execute();
	
	$notejournaladmin = 'L\'utilisateur '.$data['membre_pseudo'].' vient d\'ajouter un avertissement à l\'Utilisateur ayant l\'ID '.$_GET['id'].'.';
		
        $query2 = $db->prepare('INSERT INTO journalmodo(date,note) VALUES(:date, :note)');
		$query2->bindValue(':date',time(),PDO::PARAM_STR);
		$query2->bindValue(':note',$notejournaladmin,PDO::PARAM_STR);
		$query2->execute();
	echo'Avertissement ajouté.';
}
break;
case "del":
if (isset($_GET['id'])) // Si l'on demande de supprimer une news.
{
    // Alors on supprime la news correspondante.
    // On protège la variable « id_news » pour éviter une faille SQL.
    $_GET['id'] = ($_GET['id']);
    $retour = $db->prepare('UPDATE forum_membres SET avertissement = avertissement -1  WHERE membre_id=\'' . $_GET['id'] . '\'');
	$retour->execute();
	
	$notejournaladmin = 'L\'utilisateur '.$data['membre_pseudo'].' vient d\'enlever un avertissement à l\'Utilisateur ayant l\'ID '.$_GET['id'].'.';
		
        $query2 = $db->prepare('INSERT INTO journalmodo(date,note) VALUES(:date, :note)');
		$query2->bindValue(':date',time(),PDO::PARAM_STR);
		$query2->bindValue(':note',$notejournaladmin,PDO::PARAM_STR);
		$query2->execute();
	echo'Avertissement enlevé.';
}
break;
}

include("../includes/fin.php");
?>
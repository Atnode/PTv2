<?php
session_start();
$titre="Planète Toad &bull; Modération";
$balises = true;
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($lvl<4) header('Location: ../erreur_403.html'); 
include("../includes/menu.php");
echo'<h1>Avertissements</h1>';
$Liste = $db->prepare('SELECT * FROM forum_membres ORDER BY avertissement DESC');
$Liste->execute();
echo'<table><tbody>';
while($listeM=$Liste->fetch()) {
	echo'<tr><td>'.$listeM['membre_pseudo'].'</td><td><strong>'.$listeM['avertissement'].'</strong> averto(s) // <a href="./averto.php?action=add&id='.$listeM['membre_id'].'">Ajouter un averto</a>
	 // <a href="./averto.php?action=del&id='.$listeM['membre_id'].'">Supprimer un averto</a></td></tr>';
}
echo'</tbody></table><br />';

include("../includes/fin.php");
?>
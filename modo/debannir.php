<?php
session_start();
$titre="Planète Toad &bull; Modération";
$balises = true;
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($ip=!"78.244.63.36") { if ($lvl<4) header('Location: ../erreur_403.html'); }
include("../includes/menu.php");
echo'<h1>Débannir du site</h1>';
   echo'<h2>Débannir</h2>';
if (empty($_POST['deban'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
echo'<form method="post" action="./debannir.php">
<label for="membre">Entrez l\'ID du membre à débannir du site :</label>
        <input type="text" id="membre" name="deban">
        <input type="submit" value="Envoyer"><br /></form><br />
		ou bien <a href="./bannir.php">bannir un membre</a>.';
} else {
	 if ($_POST['membre'] == 6 OR $_POST['membre'] == 2) {
		 echo '<div style="border: 2px solid red; padding: 5px; border-radius: 5px;"><b><span style="font-size: 24px;">Vous ne pouvez pas bannir les collaborateurs de Staline Android Champoad Chromtrast, MERCI !</span></b></div>';
	 }
	 else
	 {
     $deban = $_POST['deban'];
	 //On le ban
	 $query=$db->prepare('UPDATE forum_membres SET membre_rang = 2 WHERE membre_id = :membre');
	 $query->bindValue(':membre',$deban,PDO::PARAM_INT);
	 $query->execute();
	 echo'Membre débanni.<br />
	 <a href="#null" onclick="javascript:history.back();">- Retourner à la page précédente</a>';
	 }
}

include("../includes/fin.php");
?>
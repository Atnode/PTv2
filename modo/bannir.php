<?php
session_start();
$titre="Planète Toad &bull; Modération";
$balises = true;
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($lvl<4) header('Location: ../erreur_403.html'); 
include("../includes/menu.php");
echo'<h1>Bannir du site</h1>
<h2>Bannir un membre du site</h2>';
if (empty($_POST['membre'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
echo'<form method="post" action="./bannir.php">
<label for="membre">Entrez l\'ID du membre à bannir du site :</label>
        <input type="text" id="membre" name="membre">
        <input type="submit" value="Envoyer"><br /></form><br />
		ou bien <a href="./debannir.php">débannir un membre</a>.';
} else {
     $membre = $_POST['membre'];

     $query=$db->prepare('SELECT membre_rang FROM forum_membres WHERE membre_id = '.$membre.'');
     $query->execute();
     $data = $query->fetch();
	 //On le ban
	 if ($data['membre_rang']>2) {
		 echo '<div style="border: 2px solid red; padding: 5px; border-radius: 5px;"><b><span style="font-size: 24px;">Vous ne pouvez pas bannir les collaborateurs de Staline Android Champoad Chromtrast, MERCI !</span></b></div>';
	 }
	 else
	 {
	 $query=$db->prepare('UPDATE forum_membres SET membre_rang = 0 WHERE membre_id = :membre');
	 $query->bindValue(':membre',$membre,PDO::PARAM_INT);
	 $query->execute();
	 
	 echo'Membre banni.<br>
	 <a href="#null" onclick="javascript:history.back();">- Retourner à la page précédente</a>';
	 }
}

include("../includes/fin.php");
?>
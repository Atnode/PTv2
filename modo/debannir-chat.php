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
echo'<h1>Débannir du chat</h1>';
   echo'<h2>Débannir</h2>';
if (empty($_POST['deban'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
echo'<form method="post" action="./debannir-chat.php">
<label for="membre">Entrez l\'ID du membre à débannir du chat :</label>
        <input type="text" id="membre" name="deban">
        <input type="submit" value="Envoyer"><br /></form><br />
		ou bien <a href="./bannir-chat.php">bannir un membre</a>.';
} else {
     $deban = $_POST['deban'];
	 //On le ban
	 $query=$db->prepare('DELETE FROM bannis_chat WHERE id = :membre');
	 $query->bindValue(':membre',$deban,PDO::PARAM_INT);
	 $query->execute();
	 
	 $couleur=$db->prepare('SELECT membre_pseudo, membre_couleur FROM forum_membres WHERE membre_id = :membre');
	 $couleur->bindValue(':membre',$deban,PDO::PARAM_INT);
	 $couleur->execute();
	 $result=$couleur->fetch();
	 
	 // Captain nous prévient
	 $ct=$db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES (:posteur_id, :message, :time)');
	 $ct->bindValue(':posteur_id','1',PDO::PARAM_INT);
	 $ct->bindValue(':message',"[b][couleur=".$result['membre_couleur']."]".$result['membre_pseudo']."[/couleur][/b] a été débanni du chat.",PDO::PARAM_STR);
	 $ct->bindValue(':time',time(),PDO::PARAM_INT);
	 $ct->execute();
	 echo'Membre débanni.';
}

include("../includes/fin.php");
?>
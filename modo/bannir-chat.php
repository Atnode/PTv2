<?php
session_start();
$titre="Planète Toad &bull; Modération";
$balises = true;
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
include("../includes/menu.php");
echo'<h1>Bannir du chat</h1>
<h2>Bannir</h2>';
if (empty($_POST['membre'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
echo'<form method="post" action="./bannir-chat.php">
<label for="membre">Entrez l\'ID du membre à bannir du chat :</label>
        <input type="text" id="membre" name="membre">
        <input type="submit" value="Envoyer"><br /></form><br />
		ou bien <a href="./debannir-chat.php">débannir un membre</a>.';
} else {
     $membre = $_POST['membre'];
	 //On le ban
	 if ($_POST['membre'] == 6 OR $_POST['membre'] == 2) {
		 echo '<div style="border: 2px solid red; padding: 5px; border-radius: 5px;"><b><span style="font-size: 24px;">Vous ne pouvez pas bannir les collaborateurs de Staline Android Champoad Chromtrast, MERCI !</span></b></div>';
	 }
	 else
	 {
	 $query=$db->prepare('INSERT INTO bannis_chat (id, id_bannisseur) VALUES (:membre,:id)');
	 $query->bindValue(':membre',$membre,PDO::PARAM_INT);
	 $query->bindValue(':id',$id,PDO::PARAM_INT);
	 $query->execute();
	 
	 $couleur=$db->prepare('SELECT membre_pseudo, membre_couleur FROM forum_membres WHERE membre_id = :membre');
	 $couleur->bindValue(':membre',$membre,PDO::PARAM_INT);
	 $couleur->execute();
	 $result=$couleur->fetch();
	 
	 // Captain nous prévient
	 $ct=$db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES (:posteur_id, :message, :time)');
	 $ct->bindValue(':posteur_id','1',PDO::PARAM_INT);
	 $ct->bindValue(':message',"[b][couleur=".$result['membre_couleur']."]".$result['membre_pseudo']."[/couleur][/b] a été banni du chat.",PDO::PARAM_STR);
	 $ct->bindValue(':time',time(),PDO::PARAM_INT);
	 $ct->execute();
	 
	 $notejournaladmin = 'L\'utilisateur '.$data['membre_pseudo'].' vient de bannir '.$result['membre_pseudo'].' du minichat.';
		
        $query2 = $db->prepare('INSERT INTO journalmodo(date,note) VALUES(:date, :note)');
		$query2->bindValue(':date',time(),PDO::PARAM_STR);
		$query2->bindValue(':note',$notejournaladmin,PDO::PARAM_STR);
		$query2->execute();
		
	 echo'Membre banni.';
	 }
}

include("../includes/fin.php");
?>
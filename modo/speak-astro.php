<?php
session_start();
$titre="Planète Toad &bull; Modération";
$balises = true;
$admin = 1;
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
if ($lvl<4) header('Location: ../erreur_403.html'); 
include("../includes/identifiants.php");
include("../includes/debut.php");
include("../includes/menu.php");
echo'<h1>Parler en tant qu\'Astro Toad</h1>';
if (empty($_POST['msg'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
echo'<form method="post" action="./speak-astro.php">
<label for="membre">Entrez le message :</label>
        <input type="textarea" id="msg" name="msg">
        <input type="submit" value="Envoyer"><br /></form><br />';
} else {
     $message = $_POST['msg'];
        $query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
        $query->bindValue(':posteur_id',"1",PDO::PARAM_INT);
		$query->bindValue(':message',$message,PDO::PARAM_STR);
		$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
		$query->execute();

        $query=$db->prepare('UPDATE forum_membres SET msgchat = msgchat + 3 WHERE membre_id = "1"');
        $query->execute();
		
		$notejournaladmin = 'L\'utilisateur '.$data['membre_pseudo'].' vient de faire parler AstroToad en mettant ce message "'.$message.'".';
		
        $query2 = $db->prepare('INSERT INTO journalmodo(date,note) VALUES(:date, :note)');
		$query2->bindValue(':date',time(),PDO::PARAM_STR);
		$query2->bindValue(':note',$notejournaladmin,PDO::PARAM_STR);
		$query2->execute();

	 echo'Message posté.<br>
	 <a href="#null" onclick="javascript:history.back();">- Retourner à la page précédente</a>';
}

include("../includes/fin.php");
?>
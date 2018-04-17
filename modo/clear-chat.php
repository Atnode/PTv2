<?php
session_start();
$titre="Planète Toad &bull; Modération";
$balises = true;
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
include("../includes/menu.php");
echo'<h1>Vider le chat</h1>';
if ($data['membre_id'] == 115 ) {
	echo 'Erreur 115 : Service Indisponible';
}
else
{
		    $query = $db->prepare('TRUNCATE TABLE forum_chat');
			$query->execute();
			// Ensuite on dit qui a effacé les messages
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"Messages effacés par [b][couleur=".$couleur."]".$pseudo."[/couleur][/b]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
	 
	 echo'Chat vidé.<br />
	 <a href="#null" onclick="javascript:history.back();">- Retourner à la page précédente</a>';
}

include("../includes/fin.php");
?>
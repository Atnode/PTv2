<?php
session_start();
include("./includes/identifiants.php");

//
if ($_SESSION['level']<5 AND $_SESSION['id']!="55582") header('Location: ../erreur_403.html'); // C EST UNE BETA DU CHAT DONC SEULS
// LES ADMINS PEUVENT


if (isset($_SESSION['id']) && isset($_POST['message']))
{
    if(!empty($_SESSION['id']) && !empty($_POST['message']))
    {
        //Contrôle anti flood
        $nombre_mess = $db->prepare('SELECT COUNT(*) FROM forum_chat WHERE posteur_id = :id AND timestamp > :time');
        $nombre_mess->bindValue(':id',$_SESSION['id'],PDO::PARAM_INT);
        $nombre_mess->bindValue(':time',time() - "3",PDO::PARAM_INT);
        $nombre_mess->execute();
        $nbr_mess=$nombre_mess->fetchColumn();

    	if ($nbr_mess==0 AND !ctype_space($_POST['message'])) {
	    $message = (trim($_POST['message']));
		$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
        $id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
        $pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
        $query = $db->prepare('SELECT * FROM forum_membres WHERE membre_id = :id');
        $query->bindValue(':id',$id,PDO::PARAM_INT);
		$query->execute();
        $data = $query->fetch();
        $couleur = $data['membre_couleur'];		
		
        $query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
        $query->bindValue(':posteur_id',$id,PDO::PARAM_INT);
		$query->bindValue(':message',$message,PDO::PARAM_STR);
		$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
		$query->execute();

		$query=$db->prepare('UPDATE forum_membres SET msgchat = msgchat + 1 WHERE membre_id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

		include("./includes/commandes-chat.php"); // FICHIER POUR LES COMMANDES DU CHAT

		}
    }
}
?>
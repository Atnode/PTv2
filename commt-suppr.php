<?php
session_start();
$titre="Planète Toad &bull; Poster";
include("includes/identifiants.php");
include("includes/debut.php");
if ($id==0) header('Location: erreur_403.html');
include("includes/menu.php");
$id1 = (isset($_GET['id']))?htmlspecialchars($_GET['id']):'';

if (isset($_GET['id'])) // Si l'on demande de supprimer un msg
{
    // On protège la variable « id_news » pour éviter une faille SQL.
    $_GET['id'] = ($_GET['id']);
	$verif1 = $db->prepare('SELECT * FROM commentairest WHERE id= '.$_GET['id'].'');
	$verif1->execute();
	$data34 = $verif1->fetch();
	if ($data34['id_posteur']==$id || $lvl>3) { $retour = $db->query('DELETE FROM commentaires WHERE id=\'' . $_GET['id'] . '\'');
    echo'Message supprimé. <META http-equiv="refresh" content="3; URL=./news-'.$data['id_news'].'.html">';	} 
	else {echo'<META http-equiv="refresh" content="0; URL=./erreur_403.html">'; }
} else {echo'<META http-equiv="refresh" content="0; URL=./tenninews-'.$data['id_news'].'.html">'; }
include("includes/fin.php");
?>
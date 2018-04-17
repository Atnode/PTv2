<?php
session_start();
include("./includes/identifiants.php");
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html'); 
include("./includes/debut.php");
include("./includes/menu.php");

// Faut sécuriser pour les injections SQL
$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';
$token = (isset($_GET['token']))?htmlspecialchars($_GET['token']):'';

if (!empty($action) AND !empty($token)) { // Vérif pour voir si les variables sont pas vides

  $query = $db->prepare('SELECT * FROM forum_membres WHERE membre_id = '.$id.'');
  $query->execute();
  $data = $query->fetch();

  $calculsecret = md5(($action * $id * $data['num_secret'])*3);

  if ($token==$calculsecret) { // Sacré vérif anti-triche

  	// Go BDD
  	$query = $db->prepare('INSERT INTO etoiles (id_membre,id_etoile) VALUES(:id, :etoile)');
  	$query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':etoile', $action, PDO::PARAM_INT);
    $query->execute();

   // echo'<META http-equiv="refresh" content="0; URL=/'.$_SERVER['HTTP_REFERER'].'">';
  } else {
  	echo'Bien tenté mais tu ne tricheras point.';
  }


} else { // Si c'est vide
  echo'Tu ne trouveras rien par ici.';
}
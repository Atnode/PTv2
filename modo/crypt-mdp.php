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
echo'<h1>Crypter un mdp</h1>';
if (empty($_POST['msg'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
echo'<form method="post" action="./crypt-mdp.php">
<label for="membre">Entrez le MDP à crypter :</label>
        <input type="textarea" id="msg" name="msg">
        <input type="submit" value="Envoyer"><br /></form><br />';
} else {
     $message = $_POST['msg'];
     
     $mdpcrypte = crypt('sha512', md5($message));

	 echo'Le mdp crypté est <b><u>'.$mdpcrypte.'</u></b><br><br>
	 <a href="#null" onclick="javascript:history.back();">- Retourner à la page précédente</a>';
}

include("../includes/fin.php");
?>
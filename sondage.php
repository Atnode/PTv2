<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Sondages";
$descrip = "Votez chaque semaine";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>

<h1>Sondage du Samedi 27 Juin au Vendredi 3 Juin</h1>

<p>Jouez le jeu et ne votez pas plusieurs fois.</p>

<iframe src="http://strawpoll.me/embed_1/4762665" style="width: 600px; height: 390px; border: 0;">Loading poll...</iframe>

<?php
include("includes/fin.php");
?>
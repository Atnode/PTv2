<?php
session_start();
$titre = "Planète Toad &bull; Découvrez le magnifique univers de Toad";
$descrip = "Une communauté active pour partager et découvrir de nombreuses choses sur l'univers de Toad. Inscrivez-vous pour profiter de nombreux avantages";
$canonical = "http://www.planete-toad.fr/";
$og_img = "http://www.planete-toad.fr/images/LOGOPT3100.png";
include("includes/identifiants.php");
include("includes/bbcode.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<br><h1>Planète Toad &bull; Maintenance </h1><br>
<p><center> Oups ! Bowser as capturé la page que vous souhaitez consulter ! <br>
Nous allons de ce pas aller la chercher ! <br>
Elle reviendra bientôt ! :) </p>
<img src="http://www.planete-toad.fr/images/personnage/bowser.png"/><br>
<p>En attendant, que diriez vous de <a href="/"> retourner a l'index du site </a> ?</center>
<?php
include("includes/fin.php");
?>
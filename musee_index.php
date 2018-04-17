<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Musée Toad";
$descrip = "La Zone Bonus contient des mini-jeux en flash, des avatars, des chroniques, des musiques disponibles uniquement en ligne sur Planète Toad.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./musee-toad.html">Musée Toad</a></div><br />
<h1>Musée Toad</h1>
<?php
if ($id!=0) 
{
	echo'<h2>Jeux</h2>
	
	<p>Bienvenue à l\'entrée du Musée Toad. Où voulez vous aller ?</p>
	<p align=center><a href="musee-avatars.html"><img src="images/galerie.png" alt="Galerie des avatars" title="Galerie des avatars" /></a>
	<!--<a href="musee-jeux.html"><img src="images/salle-arcade.png" alt="Salle d\'arcade" title="Salle d\'arcade" /></a>-->
	<a href="musee-chronique.html"><img src="images/chronique.png" alt="Chroniques" title="Chroniques" /></a></p>
';
	
}
else
{
	echo'<p>Bienvenue à l\'entrée du Musée Toad. Où voulez vous aller ?<br/>
		<!--<a href="musee-jeux.html">Salle d\'arcade</a></p>-->
';
}
include("includes/fin.php");
?>
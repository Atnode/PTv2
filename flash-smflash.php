<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Super Mario Flash";
$descrip = "La Zone Bonus contient des mini-jeux en flash disponibles uniquement en ligne sur Planète Toad.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./musee_index.html">Musée Toad</a> --> <a href="./musee_jeux.html">Salle d'arcade</a></div><br />
<h1>Super Mario Flash</h1>

<iframe width="662" height="547" src="http://www.megaflash.free.fr/play_game.php?id=28&color=black" scrolling="no" frameborder="0" allowfullscreen></iframe>

<?php

include("includes/fin.php");
?>
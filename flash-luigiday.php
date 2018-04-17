<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Luigi's Day";
$descrip = "La Zone Bonus contient des mini-jeux en flash disponibles uniquement en ligne sur Planète Toad.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./musee_index.html">Musée Toad</a> --> <a href="./musee_jeux.html">Salle d'arcade</a></div><br />
<h1>Luigi's Day</h1>

<iframe width="700" height="501" src="http://www.droldebiz.com/play/jeux-de-mario/luigi-s-day?&iframe=1" frameborder="0" style="overflow:hidden;"></iframe>

<?php

include("includes/fin.php");
?>
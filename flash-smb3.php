<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Super Mario Flash : Halloween Version";
$descrip = "La Zone Bonus contient des mini-jeux en flash disponibles uniquement en ligne sur Planète Toad.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./musee_index.html">Musée Toad</a> --> <a href="./musee_jeux.html">Salle d'arcade</a></div><br />
<h1>Super Mario Bros 3</h1>

<iframe height="480" width="512" src="http://static.arcadespot.com/embed/super-mario-bros-3/" border="0" frameborder="0" scrolling="no"></iframe>

<?php

include("includes/fin.php");
?>
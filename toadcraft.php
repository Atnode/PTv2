<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; ToadCraft";
$descrip = "La page de l'évenement de l'été sur Planète Toad !";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./ntxp.html">ToadCraft</a></div><br />
<h1>ToadCraft</h1>

<p>Toad Craft est le server Minecraft de Planète Toad. Il est géré par le modérateur <b>Migmangue</b> et nécéssite l'utilisation d'Hamachi. </p>

<h2>Identifiants Hamachi</h2>

<p>ID : ToadCraft PT<br/>
Mot de passe : toadcraft
</p>
<p>Une fois que vous avez rejoins le réseau, vous pouvez vous connecter à l'IP suivante : 25.62.96.231.</p><br>

<h2>Téléchargement d'Hamachi</h2><br>
<p>Afin d'utiliser ToadCraft, il faut Hamachi, <a href="/hamachi.msi">cliquez ici pour le télécharger</a>.</p>
<?php
include("includes/fin.php");
?>
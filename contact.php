<?php
session_start();
$titre = "Planète Toad &bull; Contact";
$descrip = "Cette page vous permet de contacter les membres de l'équipe de Planète Toad en cas de problème  (par exemple perte de mot de passe) qui vous en enverra un nouveau.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./contact.html">Contact</a></div><br />

<h1>Contact</h1>

<p>En cas de perte de mot de passe, de problème ou de question, vous pouvez contacter l'équipe à l'adresse : <b>planetetoad[at]gmail.com</b><br/>
<em>En cas de perte de mot de passe, je vous enverrai un nouveau mot de passe. Attention, je vous donnerai un mot de passe seulement sur l'adresse e-mail que vous avez utilisée pour le site.</em></p>

<?php
include("includes/fin.php");
?>
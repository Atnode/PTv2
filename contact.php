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
<em>En cas de perte de mot de passe, LudaWeb01 vous en enverra un nouveau par MP sur le site.</em></p>

<?php
include("includes/fin2.php");
?>
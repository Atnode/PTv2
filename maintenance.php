<?php
session_start();
$balises = true;
$titre = "Planète Toad &bull; Découvrez le magnifique univers de Toad";
$descrip = "Une communauté active pour partager et découvrir de nombreuses choses sur l'univers de Toad. Inscrivez-vous pour profiter de nombreux avantages";
$canonical = "http://www.planete-toad.fr/";
$og_img = "http://www.planete-toad.fr/images/LOGOPT3100.png";
include("includes/identifiants.php");
include("includes/bbcode.php");
include("includes/debut.php");
include("includes/menu.php");
?><center>
<h1> Maintenance </h1>
<p>Chers visiteurs et membres,<br>
Nous vous informons que Planète Toad est actuellement en maintenance.<br>
Le site est en cours de réorganisation.<br>
Cette maintenance aura une durée <em>indéterminé</em>, c'est pourquoi nous vous invitons a consulter régulièrement cette page.<br>
Nous vous invitons également a venir sur notre <em>Discord</em> afin de disposer de toutes les informations.<br><br><br>
En vous souhaitant une bonne journée/soirée !<br>
L'équipe de Planète Toad.</p><br><br>
<iframe src="https://discordapp.com/widget?id=308256814770946048&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0"></iframe>
</center>
<?php
include("includes/fin.php");
?>
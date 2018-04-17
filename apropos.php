<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; A propos du site";
$descript = "Informations sur le site Planète Toad";
$balises = true;
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./apropos.html">A propos</a></div>
<br /> <h1>A propos</h1>
<br />
<p style="margin-left: 5px;">Planète Toad dénommé P.T est un fansite crée le 30 Juillet 2014 par Champoad et Toaddle ayant pour thématique Mario et son univers. Il a été crée afin de réunir des fans de cette thématique pour qu'ils se rencontrent, partagent et découvrent de nouvelles choses.
Le design de ce site a été réalisé par Champoad.
<!-- Pour toute demande, vous pouvez contacter Planète Toad via <strong>planetetoad[at]gmail.com</strong>. --> Tout membre participant au site est bénévole. Planète Toad est hébergé chez Kovacs.</p>
<div style="text-align:right;">L'équipe de <strong>Planète Toad</strong>.</div>
<?php
include("includes/fin.php");
?>
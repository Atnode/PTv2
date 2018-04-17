<?php
session_start();
$titre = "Planète Toad &bull; Archives du chat";
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
if ($lvl<3) header('Location: 403.html'); 
$balises = true;
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
include("includes/bbcode.php");
echo'
<h1>Archives du chat</h1>
<!-- Affichage du minichat ici -->
<div id="minichat">
<table style="width:100%;"><tbody>'; 
$req = $db->query('SELECT * FROM forum_chat LEFT JOIN forum_membres ON membre_id = posteur_id ORDER BY id DESC LIMIT 0,290');
while($val = $req->fetch())
{
echo '<span class="chat"><strong><a href="/profil-'.htmlentities(stripslashes($val['membre_id'])).'.html" style="color:'.htmlentities(stripslashes($val['membre_couleur'])).';">'.htmlentities(stripslashes($val['membre_pseudo']), ENT_QUOTES, "UTF-8").'</a></strong> : '.code(nl2br(stripslashes(htmlspecialchars($val['message'])))).'<div style="text-align:right; color:grey; font-weight:bold;">['.date('H:i:s',$val['timestamp']).']</div></span><hr/>';
}
echo'
</tbody></table></div>
<!-- Fin Affichage du minichat -->';

include("includes/fin.php");
?>
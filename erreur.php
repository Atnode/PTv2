<?php
session_start();
$titre = "Planète Toad &bull; Erreur";
include("includes/identifiants.php");
if ($_GET['error']=="403") { header('HTTP/1.0 403 Forbidden'); }
if ($_GET['error']=="404") { header('HTTP/1.1 404 Not Found'); }
include("includes/debut.php");
include("includes/menu.php");
echo'<div id="filariane"><i>Vous êtes ici</i> : <a href="./" title="Index">Index</a> -> Erreur</div><br />
<h1>Erreur</h1>';
$error = isset($_GET['error'])?htmlspecialchars($_GET['error']):'';
switch($error)
{
case "404":
echo'
<p align=center style="font-size:16px; color:red; font-weight:bold;"><img src="/images/404.png" alt="404" align=center title="Page non trouvée" />
Cette page n\'a pas été trouvée. Vous pouvez <a onclick="javascript:history.back();" style="color:black; cursor:pointer;">retourner en arrière</a> ou <a href="./" style="color:black;">retourner à l\'accueil.</a>';
break;
case "403":
echo'
<p align=center style="font-size:16px; color:red; font-weight:bold;">Page indisponible ou introuvable. Vous pouvez <a onclick="javascript:history.back();" style="color:black;">retourner en arrière</a> ou <a href="./" style="color:black;">retourner à l\'accueil.</a>';
break;
default:
echo'Erreur inconnue.';
}
include("includes/fin.php");
?>

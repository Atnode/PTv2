<?php
session_start();
$titre="Planète Toad &bull; Rédaction";
$balises = true;
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($lvl!=3 OR $lvl!=5) header('Location: ../erreur_403.html'); 
include("../includes/menu.php");
echo'
<h1>Panneau de rédaction</h1>
<div style="text-align:center;"><b><u>Bonjour cher modérateur, où voulez-vous aller ?
<br /> <br /> <a href="./bannir-chat.php">- Bannir un membre du chat.</a><br /><br />
<a href="./bannir.php">- Bannir un membre du site.</a><br /><br />
<a href="./avertir.php">- Donner un averto</a><br /><br />
<a href="./sujet_verr.php">- Voir les sujets verrouillés</a><br /><br />
<a href="http://www.planete-toad.fr/archives_chat.php">- Accéder aux archives du chat</a><br /><br />
<a href="./speak-astro.php">- Parler en tant qu\'AstroToad</a><br /><br />
<a href="./clear-chat.php">- Vider le chat</a><br /><br /></u></b></div>';
include("../includes/fin.php");
?>
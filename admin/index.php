<?php
session_start();
$titre="Planète Toad &bull; Administration";
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($lvl<5) header('Location: ../erreur_404.html'); 
include("../includes/menu.php");

echo'<br><h1>Panneau d\'administration</h1><br><br>
<p style="text-align:center;">
<a href="finir-sondage.php">- Publier les résultats du sondage actuel.</a><br><br>
<a href="/modo/journal-admin-modo.php">- Jounal des modos</a></p>';
include("../includes/fin.php");
?>
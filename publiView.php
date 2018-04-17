<?php
session_start();
$titre="Planète Toad &bull; Modification de votre profil";
include("includes/identifiants.php");
include("includes/debut.php");
if ($id==0) { header('Location: connexion.html'); } else { header('Location: https://www.youtube.com/watch?v=0rXldU6oE1M'); }
?>
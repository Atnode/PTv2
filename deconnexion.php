<?php
session_start();
$token = isset($_GET['token'])?(int) $_GET['token']:'';
$titre="Planète Toad &bull; Déconnexion";
include("includes/identifiants.php");
include("includes/debut.php");
if ($id==0) header('Location: erreur_403.html');
if ($token == md5($_COOKIE['PHPSESSID'])) { // TOKEN
if (isset ($_COOKIE['id']) && isset($_COOKIE['password']))
{
setcookie('id', '', time(), null, null, false);
setcookie('password', '', time(), null, null, false);
}
session_destroy();
}

header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
include("includes/fin.php");
?>
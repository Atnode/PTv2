<?php
session_start();
$titre="Planète Toad &bull; Modération";
$balises = true;
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
if ($lvl<4) header('Location: ../erreur_403.html'); 
include("../includes/identifiants.php");
include("../includes/debut.php");
include("../includes/menu.php");
echo'<link rel="stylesheet" href="modo.css" type="text/css" />

<h1>Panneau de modération</h1>

<div style="text-align:center;">

<p><a href="./bannir.php" style="background-color:#2980b9;margin-left:1%;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">report</i>Bannissements</a></p>
<p><a href="./bannir-chat.php" style="background-color:#2980b9;margin-left:1%;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">new_releases</i>Bannissements Chat</a></p>
<p><a href="./avertir.php" style="background-color:#2980b9;margin-left:1%;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">report_problem</i>Avertissements</a></p>
<p><a href="./membres.php" style="background-color:#2980b9;margin-left:1%;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">settings</i>Gérer les membres</a></p>
<p><a href="./sujet_verr.php" style="background-color:#2980b9;margin-left:1%;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">lock_outline</i>Sujets vérouillés</a></p>
<p><a href="../archives_chat.php" style="background-color:#2980b9;margin-left:1%;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">message</i>Archives du chat</a></p>
<p><a href="./speak-astro.php"" style="background-color:#2980b9;margin-left:1%;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">send</i>Parler en tant qu\'AstroToad</a></p>
<p><a href="./clear-chat.php"" style="background-color:#2980b9;margin-left:1%;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">mode_comment</i>Clear le chat</a></p></div>';
include("../includes/fin.php");
?>
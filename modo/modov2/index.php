<link rel="stylesheet" href="modo.css" type="text/css" />
<?php
session_start();
$titre="Planète Toad &bull; Modération";
$balises = true;
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($lvl<4) header('Location: ../erreur_403.html'); 
include("../includes/menu.php");
echo'
<h1>Panneau de modération</h1>
<span class="maintenance-index"> Amis Staffiens, votre panneau de modération est actuellement en maitenance (ajout/retrait de fonctionalités et nouveau design). Des bugs sont donc suceptibles d\'apparaitre. Merci de votre compréhension. <br>
Les développeurs ~ </span><br><br>
<br /> <br /> <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><a href="./bannir.php">Bannir un membre du site.</a></button>
<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><a href="./avertir.php">Avertissements</a></button>
<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><a href="./membres.php">Gérer les membres</a></button>
<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><a href="./sujet_verr.php">Sujets vérouillés</a></button>
<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><a href="../archives_chat.php">Archvies du chat</a></button>
<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><a href="./speak-astro.php">Parler en tant qu\'AstroToad</a></button>
<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><a href="./clear-chat.php">Vider le chat</a></button><br><br>';
include("../includes/fin.php");
?>
<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
  Button
</button>
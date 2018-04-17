<?php
session_start();
$titre="Planète Toad &bull; Journal d'Admin et Modération";
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($lvl<5) header('Location: ../erreur_403.html'); 
include("../includes/menu.php");
echo'<h1>Journal d\'Administration et de Modération</h1>';
$query = $db->prepare('SELECT * FROM journalmodo ORDER BY ID DESC LIMIT 0, 50');
$query->execute();
while ($donnees=$query->fetch())
{
  $m = date('n',$donnees['date']);
  echo '<br><p><b>Le '.date('d',$donnees['date']) .' ' . getMonth($m) .' '. date('Y',$donnees['date']) .' à '. date('H:i:s',$donnees['date']) .'</b> : ' . $donnees['note'] . '</p><br><hr>';
}

include("../includes/fin.php");
?>
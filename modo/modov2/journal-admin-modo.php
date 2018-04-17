<?php
session_start();
$titre="Planète Toad &bull; Journal d'Admin et Modération";
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($lvl<4) header('Location: ../erreur_403.html'); 
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

//Mois en lettre
function getMonth($month) {
        $month_arr[1]=   "Janvier";
        $month_arr[2]=   "Février";
        $month_arr[3]=   "Mars";
        $month_arr[4]=   "Avril";
        $month_arr[5]=   "Mai";
        $month_arr[6]=   "Juin";
        $month_arr[7]=   "Juillet";
        $month_arr[8]=   "Août";
        $month_arr[9]=   "Septembre";
        $month_arr[10]=  "Octobre";
        $month_arr[11]=  "Novembre";
        $month_arr[12]=  "Décembre";

        return $month_arr[$month];
}
?>
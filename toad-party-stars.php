<?php
session_start();
include("./includes/identifiants.php");
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id==0) header('Location: erreur_403.html'); 
$diceRequete = $db->prepare('SELECT * FROM toadparty_etoiles WHERE id_joueur = '.$id.'');
$diceRequete->execute() or die(print_r($diceRequete->errorInfo()));
$data = $diceRequete->fetch();

if ($data['done']=="0") { // On lui propose d'acheter
   echo'<table class="ludaweb01" style="background-color:#e97f0a;"><tbody><tr>
   <td style="vertical-align:middle;"><img src="/images/toadparty/star.png" alt="Etoile" title="Etoile" width="100" height="100" /></td>
   <td style="padding:3px;"><br>Vous avez assez de pièces pour acheter une étoile. Souhaitez-vous acheter 1 Etoile ?<br><br>
   <a onclick="$.ajax(\'/toad-party-buy-star.php?id=0\');" style="cursor:pointer;" class="buyButton">Oui</a> &nbsp;&nbsp; 
   <a onclick="$.ajax(\'/toad-party-buy-star.php?id=1\');" style="cursor:pointer;" class="buyButton">Non</a><br><br></td>
   </tr></tbody></table>';
} elseif ($data['done']=="1") {
   echo'<table class="ludaweb01" style="background-color:#e97f0a;"><tbody><tr>
   <td style="vertical-align:middle;"><img src="/images/toadparty/star.png" alt="Etoile" title="Etoile" width="100" height="100" /></td>
   <td style="padding:3px;"><br>Vous n\'avez pas assez de pièces pour acheter une étoile. Revenez la prochaine fois.<br><br></td>
   </tr></tbody></table>';
}

?>
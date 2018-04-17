<?php
session_start();
include("./includes/identifiants.php");
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
if ($id==0) header('Location: erreur_403.html'); 
$query = $db->prepare('SELECT * FROM toadparty_participants ORDER BY id_joueur');
$query->execute();
$data = $query->fetch();

$diceRequete = $db->prepare('SELECT * FROM toadparty_dice LEFT JOIN forum_membres ON forum_membres.membre_id = toadparty_dice.id_joueur');
$diceRequete->execute() or die(print_r($diceRequete->errorInfo()));
$dice = $diceRequete->fetch();

$persoReq = $db->prepare('SELECT * FROM toadparty_participants LEFT JOIN toadparty_personnages ON toadparty_personnages.id = toadparty_participants.id_perso WHERE id_joueur = '.$dice['id_joueur'].'');
$persoReq->execute();
$perso = $persoReq->fetch();

if ($dice['id_joueur']==$id AND $dice['done']=="0") { // SI C EST A TON TOUR 
  echo'<div style="text-align:center;cursor:pointer;"><img onclick="$.ajax(\'/toad-party-lancer-de.php\');" src="/images/toadparty/dice.png" alt="Dice" title="Dé à lancer !" /><br><br>
  <span style="font-weight:bold;color:darkblue;font-size:24px;">C\'est à ton tour de lancer le dé !</span></div>';
  echo'<script> document.title="!LANCE LE DE! Planète Toad &bull; Toad Party Game"; </script>';
} elseif ($dice['id_joueur']!=$id) { // SI C EST A UN AUTRE JOUEUR
  echo'<div style="text-align:center;"><img src="/images/toadparty/dice-used.png" alt="Dice" title="Dé à lancer !" /><br><br>
  C\'est au tour de <b><span style="color:'.$perso['color_perso'].';">'.$perso['name_perso'].'</span></b></div>';
  echo'<script> document.title="Planète Toad - Toad Party Game"; </script>';
} elseif ($dice['id_joueur']==$id AND $dice['done']=="1") { // SI C EST A TON TOUR MAIS DONE 1
  echo'<div style="text-align:center;"><img src="/images/toadparty/dice-used.png" alt="Dice" title="Dé à lancer !" /><br><br>
  Merci de patienter...</div>';
  echo'<script> document.title="Planète Toad - Toad Party Game"; </script>';
}

if (time() - $dice['time']>300) { // Si ça fait plus 5 min qu il doit le lancer
	$joueurDE = $dice['id_joueur'];
	$query = $db->prepare('SELECT * FROM toadparty_participants WHERE id_joueur > '.$joueurDE.' ORDER BY id_joueur LIMIT 1');
	$query->execute();
	if ($query->rowCount()<1) {
        $firstReq = $db->prepare('SELECT * FROM toadparty_participants WHERE id_joueur <> '.$joueurDE.' ORDER BY id_joueur LIMIT 1');
        $firstReq->execute();
        $first = $firstReq->fetch();

        $changeReq = $db->prepare('UPDATE toadparty_dice SET id_joueur = '.$first['id_joueur'].', done = "0", time = '.time().'');
        $changeReq->execute();
	} else {
        $nextP = $query->fetch();
		$changeReq = $db->prepare('UPDATE toadparty_dice SET id_joueur = '.$nextP['id_joueur'].', done = "0", time = '.time().'');
        $changeReq->execute();
	}

	// On vire des participants
	$deletePart = $db->prepare('DELETE FROM toadparty_participants WHERE id_joueur = '.$joueurDE.'');
	$deletePart->execute();

   // On envoie l'évènement
   $reqPerso = $db->prepare('SELECT * FROM toadparty_personnages LEFT JOIN toadparty_participants ON toadparty_participants.id_perso = toadparty_personnages.id WHERE id_joueur = '.$joueurDE.'');
   $reqPerso->execute();
   $persoJo = $reqPerso->fetch();

   $evenement = "<b><span style=\"color:".$persoJo['color_perso'].";\">".$persoJo['name_perso']."</span></b> n'a pas lancé le dé depuis 5 minutes. Il est disqualifié.";

   $query=$db->prepare('INSERT INTO toadparty_evenements (evenement, time) VALUES(:evenement, :time)');
   $query->bindValue(':evenement', $evenement, PDO::PARAM_STR);
   $query->bindValue(':time', time(), PDO::PARAM_INT);
   $query->execute();
}
?>

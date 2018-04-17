<?php
session_start();
include("../includes/identifiants.php");
$id = $_SESSION['id'];

  // Pour les notifs
  $searchNotifs=$db->prepare('SELECT * FROM notifs WHERE id_receveur = :id AND lu = :zero');
  $searchNotifs->bindValue(':id',$id,PDO::PARAM_INT);
  $searchNotifs->bindValue(':zero','0', PDO::PARAM_STR);
  $searchNotifs->execute();
  while ($notiff = $searchNotifs->fetch()) {
  	$text = $notiff['textBrut'];
  	echo $text;
  }

?>
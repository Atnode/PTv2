<?php
session_start();
include("includes/identifiants.php");
include("includes/debut.php");
   $membre = isset($_GET['m'])?(int) $_GET['m']:'';

	$query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id=:membre');
	$query->bindValue(':membre',$membre, PDO::PARAM_INT);
	$query->execute();
	$data=$query->fetch();
		//Infos			
         $rangReq = $db->prepare('SELECT * FROM rangs WHERE tchampi_min <= '.$data['champi_total'].' AND tchampi_max >='.$data['champi_total'].'');
         $rangReq->execute();
         $rang = $rangReq->fetch();

         $calcul1 = $rang['tchampi_max'] - $rang['tchampi_min'];
         $calcul2 = $data['champi_total'] - $rang['tchampi_min'];
         $calcul3 = $calcul2 / $calcul1 * 100;
         
         $experience = substr($calcul3, 0, 2);
         echo $experience;
?>
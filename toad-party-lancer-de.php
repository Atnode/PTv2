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
if ($dice['id_joueur']==$id AND $dice['done']=="0") { // SI C EST A TON TOUR 
   // On regarde si la partie commence ou non
   $query = $db->prepare('SELECT * FROM toadparty_stats WHERE id_joueur = '.$id.'');
   $query->execute();
   $stats = $query->fetch();
   if ($query->rowCount()<1) { // Rien donc on crée
       $query=$db->prepare('INSERT INTO toadparty_stats (id_joueur, id_case, nombre_etoiles, nombre_pieces) VALUES(:id, "1", "0", "10")');
       $query->bindValue(':id', $id, PDO::PARAM_STR);
       $query->execute();
       $CaseActuelle = 1;
       $nombre_pieces = 0;
   } else { // On regarde sa case actuelle
       $CaseActuelle = $stats['id_case'];
       $nombre_pieces = $stats['nombre_pieces'];
   }

   // On lance le dé
   $NumberDice = mt_rand(1,6);

   // On envoie l'évènement
   $reqPerso = $db->prepare('SELECT * FROM toadparty_personnages LEFT JOIN toadparty_participants ON toadparty_participants.id_perso = toadparty_personnages.id WHERE id_joueur = '.$id.'');
   $reqPerso->execute();
   $perso = $reqPerso->fetch();

   $evenement = "<b><span style=\"color:".$perso['color_perso'].";\">".$perso['name_perso']."</span></b> a lancé le dé et a obtenu <b>".$NumberDice."</b>.";

   $query=$db->prepare('INSERT INTO toadparty_evenements (evenement, time) VALUES(:evenement, :time)');
   $query->bindValue(':evenement', $evenement, PDO::PARAM_STR);
   $query->bindValue(':time', time(), PDO::PARAM_INT);
   $query->execute();

   $NewCase = $CaseActuelle + $NumberDice;

   // Si le mec va plus loin de 28
   if ($NewCase=="29") { $NewCase=1; }
   if ($NewCase=="30") { $NewCase=2; }
   if ($NewCase=="31") { $NewCase=3; }
   if ($NewCase=="32") { $NewCase=4; }
   if ($NewCase=="33") { $NewCase=5; }
   if ($NewCase=="34") { $NewCase=6; }
   
   // S'il peut acheter une étoooiile
   if ($CaseActuelle<="20" AND $NewCase>="21" AND $nombre_pieces>="20") {
      $query = $db->prepare('INSERT INTO toadparty_etoiles (id_joueur, time, done) VALUES(:id,:time,"0")');
      $query->bindValue(':id', $id, PDO::PARAM_INT);
      $query->bindValue(':time', time(), PDO::PARAM_INT);
      $query->execute();
   } elseif ($CaseActuelle<="20" AND $NewCase>="21" AND $nombre_pieces<"20") { // Pas assez de fric
      $query = $db->prepare('INSERT INTO toadparty_etoiles (id_joueur, time, done) VALUES(:id,:time,"1")');
      $query->bindValue(':id', $id, PDO::PARAM_INT);
      $query->bindValue(':time', time(), PDO::PARAM_INT);
      $query->execute();
   } else { // Bah sinon nan
      $query = $db->prepare('DELETE FROM toadparty_etoiles WHERE id_joueur = :id');
      $query->bindValue(':id', $id, PDO::PARAM_INT);
      $query->execute(); 
   }

   // On actualise les stats
   $statsActualisationReq = $db->prepare('UPDATE toadparty_stats SET id_case = '.$NewCase.' WHERE id_joueur = '.$id.'');
   $statsActualisationReq->execute();

   $deActualisationReq = $db->prepare('UPDATE toadparty_dice SET done = "1"');
   $deActualisationReq->execute();

      $SearchCaseType = $db->prepare('SELECT * FROM toadparty_cases WHERE id = '.$NewCase.'');
      $SearchCaseType->execute();
      $typeCase = $SearchCaseType->fetch();
      $casetype = $typeCase['type'];

      // Grande vérification du type de case où il atterit
      if ($casetype=="casebleue") {
      	 // On actualise son nombre de pièces
      	 $query = $db->prepare('UPDATE toadparty_stats SET nombre_pieces  = nombre_pieces + 3 WHERE id_joueur = '.$id.'');
      	 $query->execute();
         
         // evenement pour les autres le voient
         $evenementCase = "<b><span style=\"color:".$perso['color_perso'].";\">".$perso['name_perso']."</span></b> a atterit sur une <b><span style=\"color:darkblue;\">Case Bleue</span></b> et gagne ainsi 3 pièces.";
      	 $query = $db->prepare('INSERT INTO toadparty_evenementCase (image, evenementCase) VALUES(:image, :evenementCase)');
      	 $query->bindValue(':image', "/images/toadparty/casebleue.png", PDO::PARAM_STR);
      	 $query->bindValue(':evenementCase', $evenementCase, PDO::PARAM_STR);
      	 $query->execute();
      }
      elseif ($casetype=="caserouge") {
      	 // On actualise son nombre de pièces
      	 $query = $db->prepare('UPDATE toadparty_stats SET nombre_pieces  = nombre_pieces - 3 WHERE id_joueur = '.$id.'');
      	 $query->execute();
         
         // evenement pour les autres le voient
         $evenementCase = "<b><span style=\"color:".$perso['color_perso'].";\">".$perso['name_perso']."</span></b> a atterit sur une <b><span style=\"color:red;\">Case Rouge</span></b> et perd donc 3 pièces.";
      	 $query = $db->prepare('INSERT INTO toadparty_evenementCase (image, evenementCase) VALUES(:image, :evenementCase)');
      	 $query->bindValue(':image', "/images/toadparty/caserouge.png", PDO::PARAM_STR);
      	 $query->bindValue(':evenementCase', $evenementCase, PDO::PARAM_STR);
      	 $query->execute();      	
      }
      elseif ($casetype=="caserelance") {
       $CaseRelance = 1;
      }
      elseif ($casetype=="caseamitie") {
      	 // On actualise son nombre de pièces
      	 $query = $db->prepare('UPDATE toadparty_stats SET nombre_pieces  = nombre_pieces + 5 WHERE id_joueur = '.$id.'');
      	 $query->execute();
         
         // On cherche un autre participant au hasard
         $randomParticipantReq = $db->prepare('SELECT * FROM toadparty_participants LEFT JOIN toadparty_personnages ON toadparty_personnages.id = toadparty_participants.id_perso WHERE id_joueur <> '.$id.' ORDER BY RAND() LIMIT 1');
         $randomParticipantReq->execute();
         $randomPart = $randomParticipantReq->fetch();

         $query = $db->prepare('UPDATE toadparty_stats SET nombre_pieces  = nombre_pieces + 5 WHERE id_joueur = '.$randomPart['id_joueur'].'');
      	 $query->execute();


         // evenement pour les autres le voient
         $evenementCase = "<b><span style=\"color:".$perso['color_perso'].";\">".$perso['name_perso']."</span></b> a atterit sur une <b><span style=\"color:orange;\">Case Amitié</span></b>. Lui et <b><span style=\"color:".$randomPart['color_perso'].";\">".$randomPart['name_perso']."</span></b> reçoivent donc 5 pièces.";
      	 $query = $db->prepare('INSERT INTO toadparty_evenementCase (image, evenementCase) VALUES(:image, :evenementCase)');
      	 $query->bindValue(':image', "/images/toadparty/caseamitie.png", PDO::PARAM_STR);
      	 $query->bindValue(':evenementCase', $evenementCase, PDO::PARAM_STR);
      	 $query->execute(); 
      }
      elseif ($casetype=="caseevenement") {
          // List des choix
          $list = array(
            '1',
            '2',
            '3'
          );

          // Compte le nombre d'élément dans la liste
          $tot = count($list);

          // Genere un nombre aléatoire entre 0 et le $tot
          $nb = mt_rand(0, $tot);

          // Le choix aléatoire
          $ques = $list[$nb];

          if ($ques=="1") {
          	$CaseRelance = 1;

         // evenement pour les autres le voient
         $evenementCase = "<b><span style=\"color:".$perso['color_perso'].";\">".$perso['name_perso']."</span></b> a atterit sur une <b><span style=\"color:darkgreen;\">Case Evenement</span></b>. Il peut donc relancer le dé une seconde fois.";
      	 $query = $db->prepare('INSERT INTO toadparty_evenementCase (image, evenementCase) VALUES(:image, :evenementCase)');
      	 $query->bindValue(':image', "/images/toadparty/caseevenement.png", PDO::PARAM_STR);
      	 $query->bindValue(':evenementCase', $evenementCase, PDO::PARAM_STR);
      	 $query->execute();
          }
          elseif ($ques=="2") {
         // On actualise son nombre de pièces
      	 $query = $db->prepare('UPDATE toadparty_stats SET nombre_etoiles  = nombre_etoiles + 1 WHERE id_joueur = '.$id.'');
      	 $query->execute();
         
         // evenement pour les autres le voient
         $evenementCase = "<b><span style=\"color:".$perso['color_perso'].";\">".$perso['name_perso']."</span></b> a atterit sur une <b><span style=\"color:darkgreen;\">Case Evenement</span></b>. Il gagne donc <b>1 étoile</b>.";
      	 $query = $db->prepare('INSERT INTO toadparty_evenementCase (image, evenementCase) VALUES(:image, :evenementCase)');
      	 $query->bindValue(':image', "/images/toadparty/caseevenement.png", PDO::PARAM_STR);
      	 $query->bindValue(':evenementCase', $evenementCase, PDO::PARAM_STR);
      	 $query->execute();
          }
          elseif ($ques=="3") {
      	 // On actualise son nombre de pièces
      	 $query = $db->prepare('UPDATE toadparty_stats SET nombre_pieces  = nombre_pieces + 10 WHERE id_joueur = '.$id.'');
      	 $query->execute();
         
         // evenement pour les autres le voient
         $evenementCase = "<b><span style=\"color:".$perso['color_perso'].";\">".$perso['name_perso']."</span></b> a atterit sur une <b><span style=\"color:darkgreen;\">Case Evenement</span></b>. Il gagne donc <b>10 pièces</b>.";
      	 $query = $db->prepare('INSERT INTO toadparty_evenementCase (image, evenementCase) VALUES(:image, :evenementCase)');
      	 $query->bindValue(':image', "/images/toadparty/caseevenement.png", PDO::PARAM_STR);
      	 $query->bindValue(':evenementCase', $evenementCase, PDO::PARAM_STR);
      	 $query->execute();
         }

      }
      elseif ($casetype=="casebowser") {
          // List des choix
          $list = array(
            '1',
            '2',
            '3',
            '4'
          );

          // Compte le nombre d'élément dans la liste
          $tot = count($list);

          // Genere un nombre aléatoire entre 0 et le $tot
          $nb = mt_rand(0, $tot);

          // Le choix aléatoire
          $ques = $list[$nb];

          if ($ques=="1") {
         // Case départ
      	 $query = $db->prepare('UPDATE toadparty_stats SET id_case = 1 WHERE id_joueur = '.$id.'');
      	 $query->execute();
         
         // evenement pour les autres le voient
         $evenementCase = "<b><span style=\"color:".$perso['color_perso'].";\">".$perso['name_perso']."</span></b> a atterit sur une <b><span style=\"color:darkred;\">Case Bowser</span></b>. Il retourne à la case départ.";
      	 $query = $db->prepare('INSERT INTO toadparty_evenementCase (image, evenementCase) VALUES(:image, :evenementCase)');
      	 $query->bindValue(':image', "/images/toadparty/casebowser.png", PDO::PARAM_STR);
      	 $query->bindValue(':evenementCase', $evenementCase, PDO::PARAM_STR);
      	 $query->execute();
          }
          elseif ($ques=="2") {
         // On actualise son nombre de pièces
      	 $query = $db->prepare('UPDATE toadparty_stats SET nombre_etoiles  = nombre_etoiles + 2 WHERE id_joueur = '.$id.'');
      	 $query->execute();
         
         // evenement pour les autres le voient
         $evenementCase = "<b><span style=\"color:".$perso['color_perso'].";\">".$perso['name_perso']."</span></b> a atterit sur une <b><span style=\"color:darkred;\">Case Bowser</span></b>. Il gagne <b>2 étoiles</b>.";
      	 $query = $db->prepare('INSERT INTO toadparty_evenementCase (image, evenementCase) VALUES(:image, :evenementCase)');
      	 $query->bindValue(':image', "/images/toadparty/casebowser.png", PDO::PARAM_STR);
      	 $query->bindValue(':evenementCase', $evenementCase, PDO::PARAM_STR);
      	 $query->execute();  
          }
          elseif ($ques=="3") {
      	 // On actualise son nombre de pièces
      	 $query = $db->prepare('UPDATE toadparty_stats SET nombre_pieces  = nombre_pieces + 20 WHERE id_joueur = '.$id.'');
      	 $query->execute();
         
         // evenement pour les autres le voient
         $evenementCase = "<b><span style=\"color:".$perso['color_perso'].";\">".$perso['name_perso']."</span></b> a atterit sur une <b><span style=\"color:darkred;\">Case Bowser</span></b>. Il gagne <b>20 pièces</b>.";
      	 $query = $db->prepare('INSERT INTO toadparty_evenementCase (image, evenementCase) VALUES(:image, :evenementCase)');
      	 $query->bindValue(':image', "/images/toadparty/casebowser.png", PDO::PARAM_STR);
      	 $query->bindValue(':evenementCase', $evenementCase, PDO::PARAM_STR);
      	 $query->execute();  
         }
          elseif ($ques=="4") {
      	 // On actualise son nombre de pièces
      	 $query = $db->prepare('UPDATE toadparty_stats SET nombre_pieces  = 0 WHERE id_joueur = '.$id.'');
      	 $query->execute();
         
         // evenement pour les autres le voient
         $evenementCase = "<b><span style=\"color:".$perso['color_perso'].";\">".$perso['name_perso']."</span></b> a atterit sur une <b><span style=\"color:darkred;\">Case Bowser</span></b>. Il perd ainsi toutes ses pièces.";
      	 $query = $db->prepare('INSERT INTO toadparty_evenementCase (image, evenementCase) VALUES(:image, :evenementCase)');
      	 $query->bindValue(':image', "/images/toadparty/casebowser.png", PDO::PARAM_STR);
      	 $query->bindValue(':evenementCase', $evenementCase, PDO::PARAM_STR);
      	 $query->execute();  
         }

      }

// Changement de possesseur
if ($CaseRelance==1) {
	$query = $db->prepare('UPDATE toadparty_dice SET done = "0", time = '.time().'');
	$query->execute();
} else {
	$idjoueurReq = $db->prepare('SELECT id_joueur FROM toadparty_dice');
	$idjoueurReq->execute();
	$dataa = $idjoueurReq->fetch();

	$query = $db->prepare('SELECT * FROM toadparty_participants WHERE id_joueur > '.$dataa['id_joueur'].' ORDER BY id_joueur LIMIT 1');
	$query->execute();
	if ($query->rowCount()<1) {
        $firstReq = $db->prepare('SELECT * FROM toadparty_participants ORDER BY id_joueur LIMIT 1');
        $firstReq->execute();
        $first = $firstReq->fetch();

        $changeReq = $db->prepare('UPDATE toadparty_dice SET id_joueur = '.$first['id_joueur'].', done = "0", time = '.time().'');
        $changeReq->execute();
	} else {
        $nextP = $query->fetch();
		$changeReq = $db->prepare('UPDATE toadparty_dice SET id_joueur = '.$nextP['id_joueur'].', done = "0", time = '.time().'');
        $changeReq->execute();
	}
}
}
?>
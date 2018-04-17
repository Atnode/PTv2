<?php
session_start();
include("../includes/identifiants.php");

		  // TOP 10 DES MEILLEURS POSTEURS DU CHAT
		//  if ($message == "/top") { TEMPOR

        // ON VIDE LE FICHIER AU DEBUT
        $ecrire = fopen('top-chat.txt',"w");
        ftruncate($ecrire,0);

		  // Requête qui sélect les 10 meilleurs posteurs
		  $retour = $db->prepare('SELECT * FROM forum_membres ORDER BY msgchat DESC LIMIT 0, 10');
          $retour->execute();
          $NumberPosition = 1; //Position du membre

          while ($donnees = $retour->fetch())
          {
          $messageTop = '[center]'.$NumberPosition.'    -      [url=/profil-'.$donnees['membre_id'].'.html][couleur='.$donnees['membre_couleur'].']'.$donnees['membre_pseudo'].'[/couleur][/url]              -      '.$donnees['msgchat'].' messages [/center]
          ';
          $NumberPosition++;

          // Ecriture dans le fichier text
          $fp = fopen('top-chat.txt', 'ab+');
          fwrite($fp, $messageTop);

          }

$messageAenvoyerReal = file_get_contents('top-chat.txt');

			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',$messageAenvoyerReal,PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute() or die(print_r($query->errorInfo()));

        // ON VIDE LE FICHIER A LA FIN
        $ecrire = fopen('top-chat.txt',"w");
        ftruncate($ecrire,0);
		//  } TEMPOR
?>
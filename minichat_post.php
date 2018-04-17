<?php
session_start();
include("./includes/identifiants.php");


if (isset($_SESSION['id']) && isset($_POST['message']))
{
    if(!empty($_SESSION['id']) && !empty($_POST['message']))
    {
        //Contrôle anti flood
        $nombre_mess = $db->prepare('SELECT COUNT(*) FROM forum_chat WHERE posteur_id = :id AND timestamp > :time');
        $nombre_mess->bindValue(':id',$_SESSION['id'],PDO::PARAM_INT);
        $nombre_mess->bindValue(':time',time() - "3",PDO::PARAM_INT);
        $nombre_mess->execute();
        $nbr_mess=$nombre_mess->fetchColumn();
        
        // ESpace insécable
        $_POST['message'] = str_replace("/\s|&nbsp;/",'',$_POST['message']);

    	if ($nbr_mess==0 AND !ctype_space($_POST['message'])) {
	    $message = (trim($_POST['message']));
		$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
        $id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
        $pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
        $query = $db->prepare('SELECT * FROM forum_membres WHERE membre_id = :id');
        $query->bindValue(':id',$id,PDO::PARAM_INT);
		$query->execute();
        $data = $query->fetch();
        $couleur = $data['membre_couleur'];		
		
        $query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
        $query->bindValue(':posteur_id',$id,PDO::PARAM_INT);
		$query->bindValue(':message',$message,PDO::PARAM_STR);
		$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
		$query->execute();

		$query=$db->prepare('UPDATE forum_membres SET msgchat = msgchat + 1 WHERE membre_id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        /*if(mt_rand(0,8) == 0){
        	$envoi2 = $db->prepare('SELECT phrase FROM astro_random ORDER BY RAND() LIMIT 1');
        	$envoi2->execute();
        	$phr = $envoi2->fetch();

        $envoi = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
        $envoi->bindValue(':posteur_id','1',PDO::PARAM_INT);
		$envoi->bindValue(':message',$phr['phrase'],PDO::PARAM_STR);
		$envoi->bindValue(':timestamp',time(),PDO::PARAM_INT);
		$envoi->execute();
        } */
if ($data['membre_id'] != 0)
{
		if ($lvl>3) {
		  // Si on efface les msg
		  if ($message == "/clear") { 
		    $query = $db->prepare('TRUNCATE TABLE forum_chat');
			$query->execute();
			// Ensuite on dit qui a effacé les messages
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"Messages effacés par [b][couleur=".$couleur."]".$pseudo."[/couleur][/b]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		}
		
		// Warn
		  if ($message == "/warn comportement") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[rouge]Attention : le joueur cité ci-dessus as reçu un avertissement pour comportement[/rouge]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }

		
}
         // Si on salue AstroToad
		  if ($message == "Salut AstroToad !") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Salut [b][couleur=".$couleur."]".$pseudo."[/couleur][/b] ! Comment vas-tu aujourd'hui ?[/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
         // Si on s'en va
		  if ($message == "J'y vais, à bientôt !") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]A bientôt [b][couleur=".$couleur."]".$pseudo."[/couleur][/b] ![/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }

		  // hueure
		  if (stripos($message, 'AstroToad') !== FALSE AND stripos($message, 'quelle') !== FALSE AND stripos($message, 'heure') !== FALSE) {
		  	$heure = date("H");
		  	$minute = date("i");
		  	$seconde = date("s");
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[b][couleur=".$couleur."]".$pseudo." -> [/couleur][/b] [gris]Il est actuellement [s]".$heure."[/s] heure(s), [s]".$minute."[/s] minute(s) et [s]".$seconde."[/s] seconde(s).[/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
			$speakAstro++;
		  }
		  
		   // Philosophie notation
		  if (stripos($message, '/note') !== FALSE) {
		  	$heure = date("H");
		  	$minute = date("i");
		  	$seconde = date("s");
			$pseudonoter = substr_replace($message, '', 0, 6);
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[b]".$pseudonoter."[/b] a reçu la note de ".mt_rand(0,20)."/20 :hap:",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
			$speakAstro++;
		  }

		  // Dés
		  if (stripos($message, '/dé') !== FALSE) {
		  	$heure = date("H");
		  	$minute = date("i");
		  	$seconde = date("s");
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','900',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[b][couleur=".$couleur."]".$pseudo." -> [/couleur][/b] [gris][i]Lancement effectué : nombre [s][".mt_rand(0,6)."][/s][/i][/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
			$speakAstro++;
		  }
		  
		  // Dés 123
		  if (stripos($message, '/dé 123') !== FALSE) {
		  	$heure = date("H");
		  	$minute = date("i");
		  	$seconde = date("s");
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','900',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[b][couleur=".$couleur."]".$pseudo." -> [/couleur][/b] [gris][i]Lancement effectué : nombre [s][".mt_rand(1,3)."][/s][/i][/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
			$speakAstro++;
		  }
		  
		  // Dés 456
		  if (stripos($message, '/dé 456') !== FALSE) {
		  	$heure = date("H");
		  	$minute = date("i");
		  	$seconde = date("s");
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','900',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[b][couleur=".$couleur."]".$pseudo." -> [/couleur][/b] [gris][i]Lancement effectué : nombre [s][".mt_rand(4,6)."][/s][/i][/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
			$speakAstro++;
		  }
		  if ($lvl>3) {
		  //toadparty
		  
		  if (stripos($message, '/toadpartylaunch') !== FALSE) {
		  	$heure = date("H");
		  	$minute = date("i");
		  	$seconde = date("s");
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','900',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[bleu]Lancement de la ToadParty [/bleu]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
			$speakAstro++;
			
			$heure = date("H");
		  	$minute = date("i");
		  	$seconde = date("s");
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','900',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[bleu]Chargement des ressources néssésaires [/bleu]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
			$speakAstro++;
		  }}
		  

		  // bite
		  if (stripos($message, ' bite ') !== FALSE) { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[b][couleur=".$couleur."]".$pseudo."[/couleur][/b][gris], je crains qu'elle soit trop petite pour que tu puisses l'appeler ainsi...[/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
		  // CSS
		  if (stripos($message, ' CSS ') !== FALSE) {
    $data = array(
        "content" => "<@199238027049041931>, viens vite sur le chat de Planète Toad, quelqu'un a parlé de CSS !!",
        "username" => "AstroToad",
    );
    $curl = curl_init("https://discordapp.com/api/webhooks/331793248559300608/7fAJAeVuYPCYoI2sLLvRHOhhYgm8mbEAISB8Y0ybqMwOP4M5Rtpm8u64-lEAB7hIuWNb");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($curl);

		  }
		  
		   if (stripos($message, '/toaddle') !== FALSE) { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','3',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Je suis Toaddle, Fondateur & Webmaster de Planète Toad. Grand fan de Toad, j'aime gérer et annimer Planète Toad. Longue vie a PT ![/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
		  if (stripos($message, '/maxhu') !== FALSE) { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','15',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Je suis Maxhu, rédacteur de PT depuis la première heure, j'adore les saucisses avec du ketchup et de la moutarde. J'adore Julie Lescaut et ses poneys :hap:[/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
		  if (stripos($message, '/shadyo') !== FALSE) { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','6',PDO::PARAM_INT);
	    	$query->bindValue(':message',":hap:",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
		  if (stripos($message, '/shadyo') !== FALSE) { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','6',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]ça t'amuse de slasher mon pseudo?[/gris] :hap:",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
		  if (stripos($message, '/shadyo') !== FALSE) { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','6',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Tu sauras jamais qui je suis[/gris] :hap:",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
		  //Equipe
		  
		    if (stripos($message, '/staff') !== FALSE) { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[bleu]Webmasters : Champoad & Toaddle[/bleu]
			[rouge]Administrateurs : Layton [/rouge]
			[vert]Modérateurs : Vince et Migmangue[/vert]
			[orange]Rédacteurs : Maxhu[/orange]
			[bleu]Président/Développeur : Shadyo[/bleu]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
		  
		  
		  
		  
		  // Si on demande ce qu'il fait
		  if ($message == "Tu fais quoi AstroToad ?") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Je suis sur Planète Toad, et toi [b][couleur=".$couleur."]".$pseudo."[/couleur][/b] ?[/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
			
         // On lui répond qu'on va bien
		  if ($message == "Très bien et toi, AstroToad ?") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Je vais très bien, merci. J'espère que tu passeras une bonne journée sur Planète Toad ![/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
	   	  }
			
         // Si on lui demande qui est le membre le plus sympa
		  if ($message == "Qui est le membre le plus sympa sur Planète Toad ?") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Ce sont Toaddle et Champoad bien sûr ![/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
         // On l'appelle
		  if (stripos($message, 'AstroToad ?') !== FALSE AND empty($speakAstro)) { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Oui [b][couleur=".$couleur."]".$pseudo."[/couleur][/b] ?[/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }

         // Astro à l'envers
		  if (stripos($message, 'daotortsA') !== FALSE) { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]etrc o'uezk mp?f?, etrc dz etrc zd ctbwpbzk muc qtooz ?u ![/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
		  // On lui demande de raconter une histoire
		  if ($message == "AstroToad ! Raconte-nous une histoire !") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]D'accord [b][couleur=".$couleur."]".$pseudo."[/couleur][/b]. C'est l'histoire d'un Toad qui se balade dans la forêt... [/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
		  // Si on lui demande à quoi il joue en ce moment
		  if ($message == "AstroToad ! Tu joue à quel jeu en ce moment ?") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Je joue à [b]Capitain Toad Treasure Tracker[/b], et toi [b][couleur=".$couleur."]".$pseudo."[/couleur][/b] ?[/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
		  		  // Si on lui demande si il est déjà allé dans l'espace
		  if ($message == "AstroToad ! Tu es déjà allé dans l'espace ?") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Oui, j'y suis déjà allé avec Neil Amstoad et Buzz Altoad ! Je me rapelle de la célèbre phrase de Neil : C'est un petit pas pour Toad, mais un gros pas pour l'humanitoad ![/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
		  		  // Si on lui demande si il nous reçoit
		  if ($message == "AstroToad ! Tu nous reçois ?") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Allô Houstoad, on a eu un problème ![/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
				// Si on lui demande pourquoi il remplace Capitain Toad
		  if ($message == "AstroToad, pourquoi tu remplaces Capitaine Toad ?") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Je crois qu'il bosse avec Nintendo sur un projet sur Wii U...[/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
				// Si on lui demande pourquoi il remplace Capitain Toad
		  if ($message == "AstroToad, comment trouves-tu Champoad ?") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[gris]Je le trouve super, c'est grâce à lui que je suis ici.[/gris]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }

		  //HISTOIRE AU HASARD
		  if ($message == "/histoire") {
            $storySel = $db->prepare('SELECT * FROM astro_story WHERE id = 1');
            $storySel->execute();
            $data = $storySel->fetch();

            $story = $data['story-1'] . $pseudo . $data['story-2'];

			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',$story,PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		  
		  // A propos d'astro
		  if ($message == "/about") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[bleu]A propos d'AstroToad[/bleu]: [vert] AstroToad (C) 2014-2016,  LudaWeb01, Champoad & Toaddle pour Planète Toad. Reproduction interdite. - Version de développement (0.1.1.0) [/vert]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }

		  // A propos d'astro
		  if ($message == "/css") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','115',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[rouge]Désolé, je suis actuellement occupé à refaire le CSS du site :hap: [/rouge]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }

		  // A propos d'astro
		  if ($message == "/ludaweb01") { 
			include('./ludaweb01.php');
		  }

		  // PT Card
		  if ($message == "/card") {
		  	$query = $db->prepare('SELECT * FROM card WHERE membre_id = '.$id.'');
            $query->execute();
            $cardData = $query->fetch();
            if ($query->rowCount()>0) { // SI LE MEMBRE A UNE CARTE

		  	$chiffred = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
		  	$onlyLetter = str_replace($chiffred, "", strtolower($pseudo));
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[img]/card-".$cardData['id']."-".$onlyLetter.".png[/img]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
            } else {
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"Vous n'avez pas encore acheté de [s]Planète Toad Card[/s]. Je vous invite donc à en acheter une en vous rendant à la [url=/boutique.html]boutique[/url] !",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
            }
		  }

		  // Pyjafacts
		/*  if ($message == "/fact") {
		  	$query = $dbfacts->prepare('SELECT message FROM fact
ORDER BY RAND()
LIMIT 1');
            $query->execute();
            $factData = $query->fetch();
            $fact = $factData['message'];

			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"Voici un Pyjafact : [b]".$fact."[/b]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();            

		  } */

		  		// La musique du mois 
		  if ($message == "/musique") {
$fichier = file('musique-commands.txt'); // Nom du fichier qui contient les citations

$total = count($fichier); // Total du nombre de lignes du fichier

$i = mt_rand(0, $total-1); // Nombre au hasard entre 0 et le total du nombre de lignes
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"[b][couleur=".$couleur."]".$pseudo."[/couleur][/b], tu aimes la musique ? Voici une musique (seléctionnée par Champoad) : [url]".$fichier[$i]."[/url]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();

			$query = $db->prepare('DELETE FROM forum_chat WHERE posteur_id = '.$id.' AND timestamp = '.time().'');
			$query->execute();
		  }
		  
		  // La musique du mois 
				if ($message == "/musique -jv") { 
			$query = $db->prepare('INSERT INTO forum_chat(posteur_id,message,timestamp) VALUES(:posteur_id, :message, :timestamp)');
            $query->bindValue(':posteur_id','1',PDO::PARAM_INT);
	    	$query->bindValue(':message',"Tu aimes la musique ? Voici la musique du mois sur le thème des jeux vidéos (seléctionnée par le Staff) : [url=https://www.youtube.com/watch?v=Fn0khIn2wfc]Surprise du mois :p[/url]",PDO::PARAM_STR);
	      	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
			$query->execute();
		  }
		 
		}
    }
}

?>
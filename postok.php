<?php
session_start();
$token = isset($_GET['token'])?(int) $_GET['token']:'';
$titre="Planète Toad &bull; Poster";
include("includes/identifiants.php");
include("includes/debut.php");
if ($_SESSION['id']==0) header('Location: erreur_403.html');
include("includes/menu.php");

// TOKEN ANTI CSRF
// if ($token == md5($_COOKIE['PHPSESSID'])) { // TOKEN

    // Les invités qui veulent poster
    $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
    $query->execute();
    if ($query->rowCount()<1) {
    if (isset ($_COOKIE['id']) && isset($_COOKIE['password']))
    {
        setcookie('id', '', time(), null, null, false);
        setcookie('password', '', time(), null, null, false);
    }
    session_destroy();
    echo'<META http-equiv="refresh" content="0; URL=/erreur_403.html">';
    } else { // ANTI INVITE
//On récupère la valeur de la variable action
$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';

switch($action)
{
    //Premier cas : nouveau topic
    case "nouveautopic":
    //On passe le message dans une série de fonction
		if (!verif_auth($data['auth_annonce']) && isset($_POST['mess']))
		{
			exit('</div>');
		}

		$query=$db->prepare('SELECT topic_locked FROM forum_topic WHERE topic_id = :topic');
		$query->bindValue(':topic',$topic,PDO::PARAM_INT);
		$query->execute(); 
		$data=$query->fetch();
		if ($data['topic_locked'] != 0)
		{
			echo'Le topic est verrouillé, vous ne pouvez pas poster de message.';
		}
		$query->CloseCursor();
    break;
	
case "edit": //Si on veut éditer le $post
    //On récupère la valeur de p
    $post = (int) $_GET['p'];
 
    //On récupère le message
    $message = $_POST['message'];
    $titre_topic = $_POST['titre'];
	
    //Ensuite on vérifie que le membre a le droit d'être ici (soit le créateur soit un modo/admin)
    $query=$db->prepare('SELECT post_createur, post_texte, post_time, topic_id, auth_modo FROM forum_post
    LEFT JOIN forum_forum ON forum_post.post_forum_id = forum_forum.forum_id WHERE post_id=:post');
    $query->bindValue(':post',$post,PDO::PARAM_INT);
    $query->execute();
    $data1 = $query->fetch();
    $topic = $data1['topic_id'];
	
        $query = $db->prepare('SELECT topic_titre FROM forum_topic
        WHERE topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $data_post2=$query->fetch(); 
	
    //On récupère la place du message dans le topic (pour le lien)
    $query = $db->prepare('SELECT COUNT(*) AS nbr FROM forum_post WHERE topic_id = :topic AND post_time < '.$data1['post_time']);
    $query->bindValue(':topic',$topic,PDO::PARAM_INT);
    $query->execute();
    $data2=$query->fetch();

    if ($data1['post_createur']==$id || $lvl>3)
    {
        $query=$db->prepare('UPDATE forum_post SET post_texte = :message, last_edition = :time WHERE post_id = :post');
        $query->bindValue(':message',$message,PDO::PARAM_STR);
        $query->bindValue(':post',$post,PDO::PARAM_INT);
        $query->bindValue(':time',time(),PDO::PARAM_INT);
        $query->execute();
        $nombreDeMessagesParPage = 15;
        $nbr_post = $data2['nbr']+1;
        $page = ceil($nbr_post / $nombreDeMessagesParPage);
        $topicurl=nettoyage($data_post2['topic_titre']);
        
if ($titre_topic!=NULL) {
        $query=$db->prepare('UPDATE forum_topic SET topic_titre = :titre WHERE topic_id = :topic');
        $query->bindValue(':titre',$titre_topic,PDO::PARAM_STR);
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
}

if ($lvl>3) { // Modifier posteur
        $upidpost=$db->prepare('UPDATE forum_post SET post_createur =  :post_createur WHERE post_id = :post');
        $upidpost->bindValue(':post_createur',$_POST['id_posteur'],PDO::PARAM_INT);
        $upidpost->bindValue(':post',$post,PDO::PARAM_INT);
        $upidpost->execute();

        //Modifier genre
        $upgenrepost=$db->prepare('UPDATE forum_topic SET topic_genre =  :topic_genre WHERE topic_id = :topic');
        $upgenrepost->bindValue(':topic_genre',$_POST['genre'],PDO::PARAM_INT);
        $upgenrepost->bindValue(':topic',$topic,PDO::PARAM_INT);
        $upgenrepost->execute();
}

if ($lvl>3 AND $data1['post_createur']!=$id) { // Envoyer la notif
        $reqNotif = $db->prepare('INSERT INTO notifs (id_receveur, image, text, textBrut, time, lu) VALUES(:membre, :image, :text, :textBrut, :time, :lu)');
        $reqNotif->bindValue(':membre',$data1['post_createur'],PDO::PARAM_INT);
        $reqNotif->bindValue(':image',$avatar,PDO::PARAM_STR);
        $reqNotif->bindValue(':text',"<a href=\"/profil-".$id.".html\" style=\"font-weight:bold;color:".$couleur."\">".$pseudo."</a> a édité votre post dans le topic ".$data_post2['topic_titre'].". <a href=\"/topic-".$topic."-".$page."-".$topicurl.".html#p_".$post."\">Cliquez ici pour consulter votre message édité.</a> ",PDO::PARAM_STR);
        $reqNotif->bindValue(':text',"".$pseudo." a édité votre post dans le topic ".$data_post2['topic_titre'].".",PDO::PARAM_STR);
        $reqNotif->bindValue(':time',time(),PDO::PARAM_INT);
        $reqNotif->bindValue(':lu','0',PDO::PARAM_INT);               
        $reqNotif->execute();
}      
        echo'<META http-equiv="refresh" content="0; URL=/topic-'.$topic.'-'.$page.'-'.$topicurl.'.html#p_'.$post.'">';
}	
break;

case "delete": //Si on veut supprimer le post
    //On récupère la valeur de p
    $post = (int) $_GET['p'];
    $query=$db->prepare('SELECT post_createur, post_texte, forum_id, topic_id, auth_modo
    FROM forum_post
    LEFT JOIN forum_forum ON forum_post.post_forum_id = forum_forum.forum_id
    WHERE post_id=:post');
    $query->bindValue(':post',$post,PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();
    $topic = $data['topic_id'];
    $forum = $data['forum_id'];
	$poster = $data['post_createur'];

   
    //Ensuite on vérifie que le membre a le droit d'être ici 
    //(soit le créateur soit un modo/admin)
    if ($lvl>3)
    {   
        //Ici on vérifie plusieurs choses :
        //est-ce un premier post ? Dernier post ou post classique ?
 
        $query = $db->prepare('SELECT topic_first_post, topic_last_post FROM forum_topic
        WHERE topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $data_post=$query->fetch();
               
               
               
        //On distingue maintenant les cas
        if ($data_post['topic_first_post']==$post) //Si le message est le premier
        {
 
            //Les autorisations ont changé !
            //Normal, seul un modo peut décider de supprimer tout un topic
            //Il faut s'assurer que ce n'est pas une erreur
 
            echo'<p align=center>Vous avez choisi de supprimer un post.
            Cependant ce post est le premier du topic. Voulez vous supprimer le topic ? <br>
            <a href="./postok.php?action=delete_topic&amp;t='.$topic.'">oui</a> - <a href="./topic-'.$topic.'.html">non</a>
            </p>';
        }
        elseif ($data_post['topic_last_post']==$post)  //Si le message est le dernier
        {
 
            //On supprime le post
            $query=$db->prepare('DELETE FROM forum_post WHERE post_id = :post');
            $query->bindValue(':post',$post,PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();
           
            //On modifie la valeur de topic_last_post pour cela on
            //récupère l'id du plus récent message de ce topic
            $query=$db->prepare('SELECT post_id FROM forum_post WHERE topic_id = :topic 
            ORDER BY post_id DESC LIMIT 0,1');
            $query->bindValue(':topic',$topic,PDO::PARAM_INT);
            $query->execute();
            $data=$query->fetch();             
            $last_post_topic=$data['post_id'];
            $query->closeCursor();

            //On fait de même pour forum_last_post_id
            $query=$db->prepare('SELECT post_id FROM forum_post WHERE post_forum_id = :forum
            ORDER BY post_id DESC LIMIT 0,1');
            $query->bindValue(':forum',$forum,PDO::PARAM_INT);
            $query->execute();
            $data=$query->fetch();             
            $last_post_forum=$data['post_id'];
            $query->closeCursor();   
                   
            //On met à jour la valeur de topic_last_post
			
            $query=$db->prepare('UPDATE forum_topic SET topic_last_post = :last
            WHERE topic_last_post = :post');
            $query->bindValue(':last',$last_post_topic,PDO::PARAM_INT);
            $query->bindValue(':post',$post,PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();
 
            //On enlève 1 au nombre de messages du forum et on met à       
            //jour forum_last_post
            $query=$db->prepare('UPDATE forum_forum SET forum_post = forum_post - 1, forum_last_post_id = :last
            WHERE forum_id = :forum');
            $query->bindValue(':last',$last_post_forum,PDO::PARAM_INT);
            $query->bindValue(':forum',$forum,PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor(); 
                        
            //On enlève 1 au nombre de messages du topic
            $query=$db->prepare('UPDATE forum_topic SET  topic_post = topic_post - 1
            WHERE topic_id = :topic');
            $query->bindValue(':topic',$topic,PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor(); 
                       
            //On enlève 1 au nombre de messages du membre
            $query=$db->prepare('UPDATE forum_membres SET  membre_post = membre_post - 1
            WHERE membre_id = :id');
            $query->bindValue(':id',$poster,PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();  
                  
            $query=$db->prepare('UPDATE forum_membres SET  membre_champi = membre_champi - 1, champi_total = champi_total - 1
            WHERE membre_id = :id');
            $query->bindValue(':id',$poster,PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();                               
            //Enfin le message
            echo'<p align=center>Le message a bien été supprimé !<br> Cliquez <a href="./topic-'.$topic.'.html">ici</a> pour retourner au topic<br>
            Cliquez <a href="./">ici</a> pour revenir à l\'index.</p>';
        } else { // Si c'est un post classique
            //On supprime le post
            $query=$db->prepare('DELETE FROM forum_post WHERE post_id = :post');
            $query->bindValue(':post',$post,PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor();
                       
            //On enlève 1 au nombre de messages du forum
            $query=$db->prepare('UPDATE forum_forum SET forum_post = forum_post - 1  WHERE forum_id = :forum');
            $query->bindValue(':forum',$forum,PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor(); 
                        
            //On enlève 1 au nombre de messages du topic
            $query=$db->prepare('UPDATE forum_topic SET  topic_post = topic_post - 1
            WHERE topic_id = :topic');
            $query->bindValue(':topic',$topic,PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor(); 
                       
            //On enlève 1 au nombre de messages du membre
            $query=$db->prepare('UPDATE forum_membres SET  membre_post = membre_post - 1
            WHERE membre_id = :id');
            $query->bindValue(':id',$data['post_createur'],PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor();  
                              
            $query=$db->prepare('UPDATE forum_membres SET  membre_champi = membre_champi - 1, champi_total = champi_total - 1
            WHERE membre_id = :id');
            $query->bindValue(':id',$poster,PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();  
                        
            //Enfin le message
            echo'<p align=center>Le message a bien été supprimé !<br> Cliquez <a href="./topic-'.$topic.'-1.html">ici</a> pour retourner au topic<br>
            Cliquez <a href="./">ici</a> pour revenir à l\'index.</p>';
        }
               
    } //Fin du else
break;

case "delete_topic":
    $topic = (int) $_GET['t'];
    $query=$db->prepare('SELECT forum_topic.forum_id, auth_modo
    FROM forum_topic
    LEFT JOIN forum_forum ON forum_topic.forum_id = forum_forum.forum_id
    WHERE topic_id=:topic');
    $query->bindValue(':topic',$topic,PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();
    $forum = $data['forum_id'];
 
    //Ensuite on vérifie que le membre a le droit d'être ici  
    if ($lvl>3)
    {
        //On compte le nombre de post du topic
        $query=$db->prepare('SELECT topic_post FROM forum_topic WHERE topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch();
        $nombrepost = $data['topic_post'] + 1;
        $query->closeCursor();

        //On supprime le topic
        $query=$db->prepare('DELETE FROM forum_topic
        WHERE topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
       
        //On enlève le nombre de post posté par chaque membre dans le topic
        $query=$db->prepare('SELECT post_createur, COUNT(*) AS nombre_mess FROM forum_post
        WHERE topic_id = :topic GROUP BY post_createur');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();

        while($data = $query->fetch())
        {
            $query=$db->prepare('UPDATE forum_membres SET membre_post = membre_post - :mess WHERE membre_id = :id');
            $query->bindValue(':mess',$data['nombre_mess'],PDO::PARAM_INT);
            $query->bindValue(':id',$data['post_createur'],PDO::PARAM_INT);
            $query->execute();
                              
            $query=$db->prepare('UPDATE forum_membres SET  membre_champi = membre_champi - 1, champi_total = champi_total - 1 WHERE membre_id = :id');
            $query->bindValue(':id',$poster,PDO::PARAM_INT);
            $query->execute();
        }

        $query->CloseCursor();       
        //Et on supprime les posts !
        $query=$db->prepare('DELETE FROM forum_post WHERE topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor(); 
		
        $query=$db->prepare('DELETE FROM forum_topic_view WHERE tv_topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor(); 

        //Dernière chose, on récupère le dernier post du forum
        $query=$db->prepare('SELECT post_id FROM forum_post
        WHERE post_forum_id = :forum ORDER BY post_id DESC LIMIT 0,1');
        $query->bindValue(':forum',$forum,PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch();
 
        //Ensuite on modifie certaines valeurs :
        $query=$db->prepare('UPDATE forum_forum
        SET forum_topic = forum_topic - 1, forum_post = forum_post - :nbr, forum_last_post_id = :id
        WHERE forum_id = :forum');
        $query->bindValue(':nbr',$nombrepost,PDO::PARAM_INT);
        $query->bindValue(':id',$data['post_id'],PDO::PARAM_INT);
        $query->bindValue(':forum',$forum,PDO::PARAM_INT);
        $query->execute(); 
        $query->CloseCursor();

        //Enfin le message
        echo'<p align=center>Le topic a bien été supprimé !<br />
        Cliquez <a href="./index.html">ici</a> pour revenir à l\'index.</p>';

    } //Fin du else
break;

case "lock": //Si on veut verrouiller le topic
    //On récupère la valeur de t
    $topic = (int) $_GET['t'];
    $query = $db->prepare('SELECT forum_topic.forum_id, auth_modo FROM forum_topic
    LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id
    WHERE topic_id = :topic');
    $query->bindValue(':topic',$topic,PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();

    //Ensuite on vérifie que le membre a le droit d'être ici
    if ($lvl>3) {
        //On met à jour la valeur de topic_locked
        $query=$db->prepare('UPDATE forum_topic SET topic_locked = :lock WHERE topic_id = :topic');
        $query->bindValue(':lock',1,PDO::PARAM_STR);
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute(); 
        $query->CloseCursor();

        echo'<p align=center>Le topic a bien été verrouillé !<br>Cliquez <a href="./topic-'.$topic.'-1.html">ici</a> pour retourner au topic<br>
        Cliquez <a href="./">ici</a> pour revenir à l\'index.</p>';
    }
break;
 
case "unlock": //Si on veut déverrouiller le topic
    //On récupère la valeur de t
    $topic = (int) $_GET['t'];
    $query = $db->prepare('SELECT forum_topic.forum_id, auth_modo FROM forum_topic
    LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id
    WHERE topic_id = :topic');
    $query->bindValue(':topic',$topic,PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();
 
 //Ensuite on vérifie que le membre a le droit d'être ici
    if ($lvl>3) {
        //On met à jour la valeur de topic_locked
        $query=$db->prepare('UPDATE forum_topic SET topic_locked = :lock WHERE topic_id = :topic');
        $query->bindValue(':lock',0,PDO::PARAM_STR);
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute(); 
        $query->CloseCursor();
 
        echo'<p align=center>Le topic a bien été déverrouillé !<br> Cliquez <a href="./topic-'.$topic.'-1.html">ici</a> pour retourner au topic<br>
        Cliquez <a href="./">ici</a> pour revenir à l\'index.</p>';
    }
break;
case "deplacer":

    $topic = (int) $_GET['t'];
    $query= $db->prepare('SELECT * FROM forum_topic LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id WHERE topic_id =:topic');
    $query->bindValue(':topic',$topic,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();
    
    if ($lvl>3) {
        $destination = (int) $_POST['dest'];
        $origine = (int) $_POST['from'];
               
        //On déplace le topic
        $query=$db->prepare('UPDATE forum_topic SET forum_id = :dest WHERE topic_id = :topic');
        $query->bindValue(':dest',$destination,PDO::PARAM_INT);
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor(); 
        
        $query=$db->prepare('UPDATE forum_topic_view SET tv_forum_id = :dest WHERE tv_topic_id = :topic');
        $query->bindValue(':dest',$destination,PDO::PARAM_INT);
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor(); 
 
        //On déplace les posts
        $query=$db->prepare('UPDATE forum_post SET post_forum_id = :dest
        WHERE topic_id = :topic');
        $query->bindValue(':dest',$destination,PDO::PARAM_INT);
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute(); 
        $query->closeCursor();     
        //On s'occupe d'ajouter / enlever les nombres de post / topic aux
        //forum d'origine et de destination
        //Pour cela on compte le nombre de post déplacé
               
        
        $query=$db->prepare('SELECT COUNT(*) AS nombre_post
        FROM forum_post WHERE topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();    
        $data = $query->fetch();
        $nombrepost = $data['nombre_post'];
        $query->closeCursor();       
                
        //Il faut également vérifier qu'on a pas déplacé un post qui été
        //l'ancien premier post du forum (champ forum_last_post_id)
 
        $query=$db->prepare('SELECT post_id FROM forum_post WHERE post_forum_id = :ori
        ORDER BY post_id DESC LIMIT 0,1');
        $query->bindValue(':ori',$origine,PDO::PARAM_INT);
        $query->execute();
        $data=$query->fetch();       
        $last_post=$data['post_id'];
        $query->CloseCursor();
        
        //Puis on met à jour le forum d'origine
        $query=$db->prepare('UPDATE forum_forum SET forum_post = forum_post - :nbr, forum_topic = forum_topic - 1,
        forum_last_post_id = :id
        WHERE forum_id = :ori');
        $query->bindValue(':nbr',$nombrepost,PDO::PARAM_INT);
        $query->bindValue(':ori',$origine,PDO::PARAM_INT);
        $query->bindValue(':id',$last_post,PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();

        //Avant de mettre à jour le forum de destination il faut
        //vérifier la valeur de forum_last_post_id
        $query=$db->prepare('SELECT post_id FROM forum_post WHERE post_forum_id = :dest
        ORDER BY post_id DESC LIMIT 0,1');
        $query->bindValue(':dest',$destination,PDO::PARAM_INT);
        $query->execute();
        $data=$query->fetch();
        $last_post=$data['post_id'];
        $query->CloseCursor();

        //Et on met à jour enfin !
        $query=$db->prepare('UPDATE forum_forum SET forum_post = forum_post + :nbr,
        forum_topic = forum_topic + 1,
        forum_last_post_id = :last
        WHERE forum_id = :forum');
        $query->bindValue(':nbr',$nombrepost,PDO::PARAM_INT);
        $query->bindValue(':last',$last_post,PDO::PARAM_INT);
        $query->bindValue(':forum',$destination,PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();

        //C'est gagné ! On affiche le message
        echo'<p align=center>Le topic a bien été déplacé <br> Cliquez <a href="./topic-'.$topic.'-1.html">ici</a> pour revenir au topic<br>
        Cliquez <a href="./">ici</a> pour revenir à l\'index.</p>';
    }
break;
case "repondremp": //Si on veut répondre

    //On récupère le message
    $message = $_POST['message'];

    //On récupère la valeur de l'id du destinataire
    $dest = (int) $_GET['dest'];
    $temps = time();

      $searchAuthenticite = $db->prepare('SELECT * mp_conversations WHERE (id_createur = '.$id.' AND id_guest = '.$dest.') OR (id_createur = '.$dest.' AND id_guest = '.$id.') ');
      $searchAuthenticite->execute();
      if ($searchAuthenticite->rowCount()>0) { // SI CONVERSATION DEJA CREE ON EN RECREE PLUS
      $dataconv = $searchAuthenticite->fetch();
        $query=$db->prepare('INSERT INTO mp_texte (id_conversation, id_expediteur, id_receveur, texte, time, lu) VALUES(:idconv, :id, :iddest, :txt, :tps, :lu)'); 
        $query->bindValue(':idconv',$dataconv['id'],PDO::PARAM_INT);
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->bindValue(':iddest',$dest,PDO::PARAM_INT);   
        $query->bindValue(':txt',$message,PDO::PARAM_STR);
        $query->bindValue(':tps',$temps,PDO::PARAM_INT);
        $query->bindValue(':lu','0',PDO::PARAM_STR);
        $query->execute();

        $updateConv = $db->prepare('UPDATE mp_conversations SET last_timestamp = '.time().' WHERE id = '.$db->lastInsertId().'');
        $updateConv->execute();
        echo'<META http-equiv="refresh" content="0; URL=/conversation-'.$dataconv['id'].'.html">';   
      } else { // BAH SINON ON CREE UNE CONV
        $query=$db->prepare('INSERT INTO mp_conversations (id_createur, id_guest, last_timestamp) VALUES(:id, :iddest, :tps)'); 
        $query->bindValue(':id',$id,PDO::PARAM_INT);   
        $query->bindValue(':iddest',$dest,PDO::PARAM_INT);
        $query->bindValue(':tps',$temps,PDO::PARAM_INT);
        $query->execute();
        $idconv = $db->lastInsertId();

        $query=$db->prepare('INSERT INTO mp_texte (id_conversation, id_expediteur, id_receveur, texte, time, lu) VALUES(:idconv, :id, :iddest, :txt, :tps, :lu)'); 
        $query->bindValue(':idconv',$idconv,PDO::PARAM_INT);
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->bindValue(':iddest',$dest,PDO::PARAM_INT);
        $query->bindValue(':txt',$message,PDO::PARAM_STR);
        $query->bindValue(':tps',$temps,PDO::PARAM_INT);
        $query->bindValue(':lu','0',PDO::PARAM_STR);
        $query->execute();

        $updateConv = $db->prepare('UPDATE mp_conversations SET last_timestamp = '.time().' WHERE id = '.$db->lastInsertId().'');
        $updateConv->execute();
        echo'<META http-equiv="refresh" content="0; URL=/conversation-'.$idconv.'.html">';
     }
    break;

    case "nouveaump": //On envoie un nouveau mp

    //On récupère le titre et le message
    $message = $_POST['message'];
    $titre = $_POST['titre'];
    $temps = time();
    $dest = $_POST['to'];

    //On récupère la valeur de l'id du destinataire
    //Il faut déja vérifier le nom

    $query=$db->prepare('SELECT membre_id FROM forum_membres
    WHERE LOWER(membre_pseudo) = :dest');
    $query->bindValue(':dest',strtolower ($dest),PDO::PARAM_STR);
    $query->execute();
    if($data = $query->fetch())
    {
        $query=$db->prepare('INSERT INTO forum_mp
        (mp_expediteur, mp_receveur, mp_titre, mp_text, mp_time, mp_lu)
        VALUES(:id, :dest, :titre, :txt, :tps, :lu)'); 
        $query->bindValue(':id',$id,PDO::PARAM_INT);   
        $query->bindValue(':dest',(int) $data['membre_id'],PDO::PARAM_INT);   
        $query->bindValue(':titre',$titre,PDO::PARAM_STR);   
        $query->bindValue(':txt',$message,PDO::PARAM_STR);   
        $query->bindValue(':tps',$temps,PDO::PARAM_INT);   
        $query->bindValue(':lu','0',PDO::PARAM_STR);   
        $query->execute() or die(print_r($query->errorInfo()));

       echo'<p align=center>Votre message a bien été envoyé !<br><br>Cliquez <a href="./">ici</a> pour revenir à l\'index.<br>
       <br>Cliquez <a href="./mp.html">ici</a> pour retourner à la messagerie.</p>';
    //Sinon l'utilisateur n'existe pas !
   } else { echo'<p align=center>Désolé ce membre n\'existe pas, veuillez vérifier et réessayer à nouveau.</p>'; }
    break;
    case "nouvelleconversation": //On envoie un nouveau mp

    //On récupère le titre et le message
    $message = $_POST['message'];
    $temps = time();
    $dest = $_POST['to'];

    //On récupère la valeur de l'id du destinataire
    //Il faut déja vérifier le nom

    $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id = :dest');
    $query->bindValue(':dest',$dest,PDO::PARAM_INT);
    $query->execute();
    if ($data = $query->fetch() AND isset($dest) AND isset($message))
    {

      //Verif s ils sont amis
    $AmisYou = $db->prepare('SELECT * FROM forum_amis WHERE (ami_from = '.$id.' AND ami_to = '.$data['membre_id'].') OR (ami_from = '.$data['membre_id'].' AND ami_to = '.$id.') AND ami_confirm = "1"');
    $AmisYou->execute();
    if ($AmisYou->rowCount()>0) {

      $searchAuthenticite = $db->prepare('SELECT * mp_conversations WHERE (id_createur = '.$id.' AND id_guest = '.$data['membre_id'].') OR (id_createur = '.$data['membre_id'].' AND id_guest = '.$id.')');
      $searchAuthenticite->execute();
      if ($searchAuthenticite->rowCount()>0) { // SI CONVERSATION DEJA CREE ON EN RECREE PLUS
      $dataconv = $searchAuthenticite->fetch();
        $query=$db->prepare('INSERT INTO mp_texte (id_conversation, id_expediteur, id_receveur, texte, time, lu) VALUES(:idconv, :id, :iddest, :txt, :tps, :lu)'); 
        $query->bindValue(':idconv',$dataconv['id'],PDO::PARAM_INT);   
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->bindValue(':iddest',$dest,PDO::PARAM_INT);   
        $query->bindValue(':txt',$message,PDO::PARAM_STR);
        $query->bindValue(':tps',$temps,PDO::PARAM_INT);   
        $query->bindValue(':lu','0',PDO::PARAM_STR);
        $query->execute();

        $updateConv = $db->prepare('UPDATE mp_conversations SET last_timestamp = '.time().' WHERE id = '.$db->lastInsertId().'');
        $updateConv->execute();
        echo'<META http-equiv="refresh" content="0; URL=/conversation-'.$dataconv['id'].'.html">';   
      } else { // BAH SINON ON CREE UNE CONV
        $query=$db->prepare('INSERT INTO mp_conversations (id_createur, id_guest, last_timestamp) VALUES(:id, :iddest, :tps)'); 
        $query->bindValue(':id',$id,PDO::PARAM_INT);   
        $query->bindValue(':iddest',$dest,PDO::PARAM_INT);
        $query->bindValue(':tps',$temps,PDO::PARAM_INT);
        $query->execute();
        $idconv = $db->lastInsertId();

        $query=$db->prepare('INSERT INTO mp_texte (id_conversation, id_expediteur, id_receveur, texte, time, lu) VALUES(:idconv, :id, :iddest, :txt, :tps, :lu)'); 
        $query->bindValue(':idconv',$idconv,PDO::PARAM_INT);   
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->bindValue(':iddest',$dest,PDO::PARAM_INT);   
        $query->bindValue(':txt',$message,PDO::PARAM_STR);
        $query->bindValue(':tps',$temps,PDO::PARAM_INT);   
        $query->bindValue(':lu','0',PDO::PARAM_STR);
        $query->execute();

        $updateConv = $db->prepare('UPDATE mp_conversations SET last_timestamp = '.time().' WHERE id = '.$db->lastInsertId().'');
        $updateConv->execute();
        echo'<META http-equiv="refresh" content="0; URL=/conversation-'.$idconv.'.html">';
      }
    } // FIN IF VERIF AMI
    //Sinon l'utilisateur n'existe pas !
   } else { echo'<p align=center>Désolé ce membre n\'existe pas, veuillez vérifier et réessayer à nouveau.</p>'; }
    break;
	case "publier":
	$publier = $_POST['publier'];
	$membre = $_GET['id'];
	if ($publier!=NULL) {
        $query=$db->prepare('INSERT INTO publications (id_posteur, id_receveur, message, timestamp) VALUES(:id, :membre, :publier, :date)');
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->bindValue(':membre',(int) $membre,PDO::PARAM_INT); 
        $query->bindValue(':publier',$publier,PDO::PARAM_STR);  
        $query->bindValue(':date',time(),PDO::PARAM_INT);
        $query->execute();
        $newpubli = $db->lastInsertId();

        // Faire une notif
        if ($id!=$membre) {
            $message = '<a href="/profil-'.$id.'.html" style="color:'.$couleur.';">'.$pseudo.'</a> a publié sur votre mur. 
            <a href="publi-'.$newpubli.'.html">Cliquez ici pour consulter la publication.</a>';
            $messageBrut = ''.$pseudo.' a publié sur votre mur.';
            $sendNotif = $db->prepare('INSERT INTO notifs (id_receveur, image, text, textBrut, time, lu) VALUES(:membre, :image, :text, :textBrut, :time, :lu)');
            $sendNotif->bindValue(':membre',$membre,PDO::PARAM_INT);
            $sendNotif->bindValue(':image',$avatar,PDO::PARAM_STR);
            $sendNotif->bindValue(':text',$message,PDO::PARAM_STR);
            $sendNotif->bindValue(':textBrut',$messageBrut,PDO::PARAM_STR);
            $sendNotif->bindValue(':time',time(),PDO::PARAM_INT);
            $sendNotif->bindValue(':lu','0',PDO::PARAM_STR);
            $sendNotif->execute() or die(print_r($sendNotif->errorInfo()));
        }
        echo'<META http-equiv="refresh" content="0; URL=/publi-'.$newpubli.'.html">';
	} else { echo'Publication vide'; }
	break;
	case "suppr_publi":
	$publi = $_GET['id'];
        $search=$db->prepare('SELECT id_posteur FROM publications WHERE id = :publi'); 
        $search->bindValue(':publi',$publi,PDO::PARAM_INT);   
        $search->execute();
		$data = $search->fetch();
	$publicateur = $data['id_posteur'];
	if ($publicateur==$id OR $lvl>3) {
        $del=$db->prepare('DELETE FROM publications WHERE id = :publi');
        $del->bindValue(':publi',$publi,PDO::PARAM_INT);
        $del->execute();
        //On suppr les comms
        $delComm=$db->prepare('DELETE FROM publis_com WHERE id_publi = :publi');
        $delComm->bindValue(':publi',$publi,PDO::PARAM_INT);
        $delComm->execute();
		?>
		<script>history.go(-1)</script>
		<?php
	    echo'<p align=center>Cette publication a bien été supprimée. <a onclick="javascript:history.back();" style="color:black;">Vous pouvez retourner sur le profil du membre en cliquant ici.</a></p>';
	} else { echo'Vous n\'avez pas les droits nécéssaires.'; }
	break;
	case "comment_publi":
	$publi = $_GET['id'];
	$commentaire = $_POST['commenter'];
	if ($commentaire!=NULL) {
        $comment=$db->prepare('INSERT INTO publis_com
        (id_posteur, id_publi, texte, timestamp)
        VALUES(:id, :publi, :commentaire, :date)'); 
        $comment->bindValue(':id',$id,PDO::PARAM_INT);   
        $comment->bindValue(':publi',(int) $publi,PDO::PARAM_INT);   
        $comment->bindValue(':commentaire',$commentaire,PDO::PARAM_STR);   
        $comment->bindValue(':date',time(),PDO::PARAM_INT);   
        $comment->execute() or die(print_r($comment->errorInfo()));
	   
 $searchPosteur = $db->prepare('SELECT * FROM publications WHERE id = '.$publi.'');
 $searchPosteur->execute();
 $data = $searchPosteur->fetch();
 $membre = $data['id_posteur'];
        // Faire une notif
        if ($id!=$membre) {
            $message = '<a href="/profil-'.$id.'.html" style="color:'.$couleur.';">'.$pseudo.'</a> a commenté votre publication. 
            <a href="publi-'.$publi.'.html">Cliquez ici pour consulter la publication.</a>';
            $messageBrut = ''.$pseudo.' a commenté votre publication.';
            $sendNotif = $db->prepare('INSERT INTO notifs (id_receveur, image, text, textBrut, time, lu) VALUES(:membre, :image, :text, :textBrut, :time, :lu)');
            $sendNotif->bindValue(':membre',$membre,PDO::PARAM_INT);
            $sendNotif->bindValue(':image',$avatar,PDO::PARAM_STR);
            $sendNotif->bindValue(':text',$message,PDO::PARAM_STR);
            $sendNotif->bindValue(':textBrut',$messageBrut,PDO::PARAM_STR);
            $sendNotif->bindValue(':time',time(),PDO::PARAM_INT);
            $sendNotif->bindValue(':lu','0',PDO::PARAM_STR);
            $sendNotif->execute();
        }

    }
    break;
	case "suppr_chat":
		$publi = $_GET['id'];
        $search=$db->prepare('SELECT posteur_id FROM forum_chat WHERE id = :publi'); 
        $search->bindValue(':publi',$publi,PDO::PARAM_INT);   
        $search->execute();
		$data = $search->fetch();
		$publicateur = $data['posteur_id'];
		if ($publicateur==$id OR $lvl>3) {
			$del=$db->prepare('DELETE FROM forum_chat WHERE id = :publi');
			$del->bindValue(':publi',$publi,PDO::PARAM_INT);
			$del->execute();

            $supprMsg=$db->prepare('UPDATE forum_membres SET msgchat = msgchat - 1 WHERE membre_id = :id_posteur');
            $supprMsg->bindValue(':id_posteur',$publicateur,PDO::PARAM_INT);
            $supprMsg->execute(); // On vire le message du compteur des msg
			header('Location: '.$_SERVER['HTTP_REFERER'].'');
            ?>
			<?php
		} else { echo'Vous n\'avez pas les droits nécéssaires.'; }
	break;
    default;
    echo'<p align=center>Cette action est impossible</p>';
} //Fin du Switch
} // ANTI INVITE
//} //ANTI CSRF
include("includes/fin.php");
?>
<?php
session_start();
include("../includes/identifiants.php");
include("../includes/functions.php");
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($_SESSION['id']==0) header('Location: /erreur_403.html');

    // Les invités qui veulent poster
    $infosMembreReq=$db->prepare('SELECT * FROM forum_membres WHERE membre_id= '.$id.'');
    $infosMembreReq->execute();
    $infosMembre = $infosMembreReq->fetch();
    $avatar = $infosMembre['membre_avatar'];
    $couleur = $infosMembre['membre_couleur'];
    $pseudo = $infosMembre['membre_pseudo'];
    $champi_total = $infosMembre['champi_total'];
    if ($infosMembreReq->rowCount()<1) {
    if (isset($_COOKIE['id']) && isset($_COOKIE['password']))
    {
        setcookie('id', '', time(), null, null, false);
        setcookie('password', '', time(), null, null, false);
    }
    session_destroy();
    echo'<META http-equiv="refresh" content="0; URL=/erreur_403.html">';
    } else { // ANTI INVITE
    $message = $_POST['message'];

    //ici seulement, maintenant qu'on est sur qu'elle existe, on récupère la valeur de la variable t
    $topic = (int) $_GET['t'];
    $temps = time();

    if (empty($message))
    {
        echo'<br><p align=center>Votre message est vide, cliquez <a href="javascript:history.back()">ici</a> pour recommencer</p>';
    }
    else //Sinon, si le message n'est pas vide
    {
        //Contrôle anti flood
        $nombre_mess = $db->prepare('SELECT COUNT(*) FROM forum_post WHERE post_createur = :id AND post_time > :time');
        $nombre_mess->bindValue(':id',$id,PDO::PARAM_INT);
        $nombre_mess->bindValue(':time',time() - "10",PDO::PARAM_INT);
        $nombre_mess->execute();
        $nbr_mess=$nombre_mess->fetchColumn();
        if ($nbr_mess!=0)
        {
            echo'<p style="text-align:center;">Vous ne pouvez pas poster un nouveau message si tôt après le dernier.</p>';
        } else {
            //On récupère l'id du forum
            $RecupInfosReq=$db->prepare('SELECT * FROM forum_topic WHERE topic_id = :topic');
            $RecupInfosReq->bindValue(':topic', $topic, PDO::PARAM_INT);    
            $RecupInfosReq->execute();
            $data=$RecupInfosReq->fetch();
            $forum = $data['forum_id'];
            $topic_titre = $data['topic_titre'];
            $topic_post = $data['topic_post'];

            //Puis on entre le message
            $reqMessage=$db->prepare('INSERT INTO forum_post
            (post_createur, post_texte, post_time, topic_id, post_forum_id)
            VALUES(:id,:mess,:temps,:topic,:forum)');
            $reqMessage->bindValue(':id', $id, PDO::PARAM_INT);   
            $reqMessage->bindValue(':mess', $message, PDO::PARAM_STR);  
            $reqMessage->bindValue(':temps', $temps, PDO::PARAM_INT);  
            $reqMessage->bindValue(':topic', $topic, PDO::PARAM_INT);   
            $reqMessage->bindValue(':forum', $forum, PDO::PARAM_INT); 
            $reqMessage->execute();

            $nouveaupost = $db->lastInsertId();
            $reqMessage->closeCursor(); 

            //On change un peu la table forum_topic
            $update1=$db->prepare('UPDATE forum_topic SET topic_post = topic_post + 1, topic_last_post = :nouveaupost WHERE topic_id =:topic');
            $update1->bindValue(':nouveaupost', (int) $nouveaupost, PDO::PARAM_INT);   
            $update1->bindValue(':topic', (int) $topic, PDO::PARAM_INT); 
            $update1->execute();
            $update1->closeCursor(); 

            //Puis même combat sur les 2 autres tables
            $update2=$db->prepare('UPDATE forum_forum SET forum_post = forum_post + 1 , forum_last_post_id = :nouveaupost WHERE forum_id = :forum');
            $update2->bindValue(':nouveaupost', (int) $nouveaupost, PDO::PARAM_INT);   
            $update2->bindValue(':forum', (int) $forum, PDO::PARAM_INT); 
            $update2->execute();
            $update2->closeCursor(); 

            $update3=$db->prepare('UPDATE forum_membres SET membre_post = membre_post + 1, membre_champi = membre_champi + 1, champi_total = champi_total + 1 WHERE membre_id = :id');
            $update3->bindValue(':id', $id, PDO::PARAM_INT); 
            $update3->execute();
            $update3->closeCursor();

            // Regarder si le membre a augmenté de rang
            $update4 = $db->prepare('SELECT nom FROM forum_membres LEFT JOIN rangs ON rangs.tchampi_min = forum_membres.champi_total WHERE tchampi_min <= '.$champi_total.' AND tchampi_max >='.$champi_total.' AND membre_id = '.$id.'');
            $update4->execute();
            $oldRankData = $update4->fetch();
            $oldRank = $oldRank['nom'];

            $update5 = $db->prepare('SELECT nom FROM forum_membres LEFT JOIN rangs ON rangs.tchampi_min = forum_membres.champi_total WHERE tchampi_min <= champi_total AND tchampi_max >= champi_total AND membre_id = '.$id.'');
            $update5->execute();
            $newRankData = $update5->fetch();
            $newRank = $newRank['nom'];

            if ($oldRank!=$newRank) { // DANS CE CAS PUBLI
             $reqRang = $db->prepare('INSERT INTO publications (id_posteur, id_receveur, message, timestamp, officielle) VALUES(:id, :id, :text, :time, :officielle)');
             $reqRang->bindValue(':id',$id,PDO::PARAM_INT);
             $reqRang->bindValue(':text',"[b][couleur=".$couleur."]".$pseudo."[/couleur][/b] est passé au [b]rang ".$newRankData['nom']."[/b]",PDO::PARAM_STR);
             $reqRang->bindValue(':time',time(),PDO::PARAM_INT);
             $reqRang->bindValue(':officielle','1',PDO::PARAM_INT);
             $reqRang->execute();
            }

            //On update la table forum_topic_view
            //On ajoute une ligne dans la table forum_topic_view
            $req = $db->prepare('SELECT membre_id FROM forum_membres WHERE membre_id != '.$id.'');
            $req->execute();
            while($kek = $req->fetch())
            {
                $InsertView=$db->prepare('INSERT INTO forum_topic_view (tv_id, tv_topic_id, tv_forum_id) VALUES ('.$kek['membre_id'].', '.$topic.', '.$forum.')');
                $InsertView->execute();
            }

            $nombreDeMessagesParPage = 15;
            $nbr_post = $topic_post +1;
            $page = ceil($nbr_post / $nombreDeMessagesParPage);
            $topicurl=nettoyage($topic_titre);

            // Notif à ceux qui suivent le topic
            $followersReq = $db->prepare('SELECT * FROM topics_suivis WHERE id_topic = '.$topic.' AND id_membre <> '.$id.'');
            $followersReq->execute();
            while($data2 = $followersReq->fetch()) {
             $reqNotif = $db->prepare('INSERT INTO notifs (id_receveur, image, text, textBrut, time, lu) VALUES(:membre, :image, :text, :textBrut, :time, :lu)');
             $reqNotif->bindValue(':membre',$data2['id_membre'],PDO::PARAM_INT);
             $reqNotif->bindValue(':image',$avatar,PDO::PARAM_STR);
             $reqNotif->bindValue(':text',"<a href=\"/profil-".$id.".html\" style=\"font-weight:bold;color:".$couleur."\">".$pseudo."</a> a posté un message dans un topic que vous suivez (<i>".$topic_titre."</i>). <a href=\"/topic-".$topic."-".$page."-".$topicurl.".html#p_".$nouveaupost."\">Cliquez ici pour consulter le message.</a> ",PDO::PARAM_STR);
             $reqNotif->bindValue(':textBrut',"".$pseudo." a posté un message dans un topic que vous suivez (".$topic_titre.").",PDO::PARAM_STR);
             $reqNotif->bindValue(':time',time(),PDO::PARAM_INT);
             $reqNotif->bindValue(':lu','0',PDO::PARAM_INT);
             $reqNotif->execute(); 
            }

            //REDIRECTION VERS LE TOPIC
            header('Location: /topic-'.$topic.'-'.$page.'-'.$topicurl.'.html#p_'.$nouveaupost.'');
        }
}
}
?>
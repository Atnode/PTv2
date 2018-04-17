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
    $mess = $_POST['mess'];

    //Pareil pour le titre
    $titre = $_POST['titre'];

    //ici seulement, maintenant qu'on est sur qu'elle existe, on récupère la valeur de la variable f
    $forum = (int) $_GET['f'];
    $temps = time();

    if (empty($message) || empty($titre))
    {
        echo'<p align=center>Votre message ou votre titre est vide, 
        cliquez <a href="javascript:history.back()">ici</a> pour recommencer</p>';
    }
    else //Si jamais le message n'est pas vide
    {
        if ($forum!="11") {
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
                if (empty($mess)) { $mess="Message"; }
                //On entre le topic dans la base de donnée en laissant
                //le champ topic_last_post à 0
                $query=$db->prepare('INSERT INTO forum_topic (forum_id, topic_titre, topic_createur, topic_vu, topic_time, topic_genre) VALUES(:forum, :titre, :id, 1, :temps, :mess)');
                $query->bindValue(':forum', $forum, PDO::PARAM_INT);
                $query->bindValue(':titre', $titre, PDO::PARAM_STR);
                $query->bindValue(':id', $id, PDO::PARAM_INT);
                $query->bindValue(':temps', $temps, PDO::PARAM_INT);
                $query->bindValue(':mess', $mess, PDO::PARAM_STR);
                $query->execute();
                $nouveautopic = $db->lastInsertId(); //Notre fameuse fonction !

                //Puis on entre le message
                $query=$db->prepare('INSERT INTO forum_post (post_createur, post_texte, post_time, topic_id, post_forum_id) VALUES (:id, :mess, :temps, :nouveautopic, :forum)');
                $query->bindValue(':id', $id, PDO::PARAM_INT);
                $query->bindValue(':mess', $message, PDO::PARAM_STR);
                $query->bindValue(':temps', $temps,PDO::PARAM_INT);
                $query->bindValue(':nouveautopic', (int) $nouveautopic, PDO::PARAM_INT);
                $query->bindValue(':forum', $forum, PDO::PARAM_INT);
                $query->execute();
                $nouveaupost = $db->lastInsertId(); //Encore notre fameuse fonction !
                $query->CloseCursor(); 

                //Ici on update comme prévu la valeur de topic_last_post et de topic_first_post
                $query=$db->prepare('UPDATE forum_topic
                SET topic_last_post = :nouveaupost,
                topic_first_post = :nouveaupost
                WHERE topic_id = :nouveautopic');
                $query->bindValue(':nouveaupost', (int) $nouveaupost, PDO::PARAM_INT);    
                $query->bindValue(':nouveautopic', (int) $nouveautopic, PDO::PARAM_INT);
                $query->execute();
                $query->CloseCursor();

                //Enfin on met à jour les tables forum_forum et forum_membres et les Champis
                $query=$db->prepare('UPDATE forum_forum SET forum_post = forum_post + 1 ,forum_topic = forum_topic + 1, forum_last_post_id = :nouveaupost 
                WHERE forum_id = :forum');
                $query->bindValue(':nouveaupost', (int) $nouveaupost, PDO::PARAM_INT);    
                $query->bindValue(':forum', (int) $forum, PDO::PARAM_INT);
                $query->execute();
                $query->closeCursor();
            
                $query=$db->prepare('UPDATE forum_membres SET membre_post = membre_post + 1 WHERE membre_id = :id');
                $query->bindValue(':id', $id, PDO::PARAM_INT);    
                $query->execute();
                $query->closeCursor();
                
                $query=$db->prepare('UPDATE forum_membres SET membre_champi = membre_champi + 2, champi_total = champi_total + 2 WHERE membre_id = :id');
                $query->bindValue(':id', $id, PDO::PARAM_INT);    
                $query->execute();
                $query->closeCursor();

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

                //On ajoute une ligne dans la table forum_topic_view
                $req = $db->query('SELECT membre_id FROM forum_membres WHERE membre_id != '.$id.'');
                while($data = $req->fetch())
                {
                    $query=$db->prepare('INSERT INTO forum_topic_view (tv_id, tv_topic_id, tv_forum_id) VALUES ('.$data['membre_id'].', '.$nouveautopic.', '.$forum.')');
                    $query->execute();
                    $query->closeCursor();
                }
                //Redirection
                $topicurl=nettoyage($titre);
                header('Location: /topic-'.$nouveautopic.'-1-'.$topicurl.'.html');
            }
}
}
}
?>
<?php
session_start();
$forum = (int) $_GET['f'];
include("includes/identifiants.php");
$reponse = $db->prepare('SELECT * FROM forum_forum WHERE forum_id=' . $forum . '');
$reponse->execute();
$data1 = $reponse->fetch();

$titre =  ''.$data1['forum_name'].'';
$descrip = "Lire les sujets du forum ".$data1['forum_name']." sur Planète Toad";
include("includes/debut.php");
//A partir d'ici, on va compter le nombre de messages
//pour n'afficher que les 25 premiers
if ($data1['auth_view']>$lvl) header('Location: erreur_403.html');
$auth_view = $data1['auth_view'];
$totalDesMessages = $data1['forum_topic'];
$url = $data1['url'];
$nombreDeMessagesParPage = 15;
$nombreDePages = ceil($totalDesMessages / $nombreDeMessagesParPage);
include("includes/menu.php");

echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./forum.html">Forum</a> --> 
<a href="./forum-'.$forum.'-'.$data1['url'].'.html">'.$data1['forum_name'].'</a></div><br><br>';

if ($id!=0) {
if ($lvl>=$auth_view) {
//Et le bouton pour poster
echo'<a href="./poster.php?action=nouveautopic&amp;f='.$forum.'">
<img src="./images/nouveau.png" alt="Nouveau topic" title="Poster un nouveau topic" /></a>';
} }
//Nombre de pages
$page = (isset($_GET['page']))?intval($_GET['page']):1;
//On affiche les pages 1-2-3, etc.
echo '<ul class="pagination modal-4" style="float:right;">';
echo get_list_page_MDesign($page, $nombreDePages, './forum-'.$forum.'-', $url);
echo'</ul><div class="clearboth"></div>';

$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;

//Le titre du forum
echo '<div class="allcat"><div class="cattitle">'.$data1['forum_name'].'</div>';
echo'<div class="allforum">';
//On prend tout ce qu'on a sur les Annonces du forum
       

//Premièrement, sélection des champs
$add1 = 'tv_id,'; 
//Deuxièmement, jointure
$add2 = 'LEFT JOIN forum_topic_view ON forum_topic.topic_id = forum_topic_view.tv_topic_id AND forum_topic_view.tv_id = :id';
$queryMess=$db->prepare('SELECT forum_topic.topic_id, topic_titre, topic_createur, topic_vu, topic_post, topic_genre, topic_time, topic_last_post, topic_locked,
Mb.membre_pseudo AS membre_pseudo_createur, post_createur, post_time, Ma.membre_pseudo AS membre_pseudo_last_posteur, tv_topic_id, 
'.$add1.' post_id, Mb.membre_couleur AS mb_membre_couleur, Ma.membre_couleur AS ma_membre_couleur, Ma.membre_avatar AS membre_avatar FROM forum_topic 
LEFT JOIN forum_membres Mb ON Mb.membre_id = forum_topic.topic_createur
LEFT JOIN forum_post ON forum_topic.topic_last_post = forum_post.post_id
LEFT JOIN forum_membres Ma ON Ma.membre_id = forum_post.post_createur
'.$add2.'
WHERE (topic_genre = "Annonce" AND forum_topic.forum_id = :forum) OR topic_genre = "Annonce Globale" 
ORDER BY topic_last_post DESC LIMIT :premier ,:nombre');
$queryMess->bindValue(':forum',$forum,PDO::PARAM_INT);
$queryMess->bindValue(':premier',$premierMessageAafficher,PDO::PARAM_INT);
$queryMess->bindValue(':nombre',$nombreDeMessagesParPage,PDO::PARAM_INT);
$queryMess->bindValue(':id',$id,PDO::PARAM_INT);
$queryMess->execute();

if ($queryMess->rowCount()>0) {
        //On commence la boucle
        while ($queryTopic=$queryMess->fetch())
        {
                //Si le topic est une annonce on l'affiche en haut               
if ($id!=0)
{
  if ($queryTopic['tv_id'] == $id && $queryTopic['tv_topic_id'] == $queryTopic['topic_id']) { //S'il a pas lu le topic
  if ($queryTopic['topic_genre']=="Annonce") { // ANNONCE SIMPLE

        $ico_mess = '<img src="/images/newicon-annonce.png" alt="Nouveau message" title="Nouveau message" />';
        $newpost = 'style="color:#da8500;"';
  } elseif ($queryTopic['topic_genre']=="Annonce Globale") {
    if ($queryTopic['tv_id'] == $id && $queryTopic['tv_topic_id'] == $queryTopic['topic_id']) //S'il a pas lu le topic
    {
        $ico_mess = '<img src="/images/newicon-annonceglob.png" alt="Nouveau message" title="Nouveau message" />';
        $newpost = 'style="color:#da000c;"';
    }
  }
  }
    else //S'il a  lu le topic
    {
        $ico_mess = '<img src="/images/oldicon-annonce.png" alt="Pas de nouveau message" title="Pas de nouveau message" />';
        $newpost = 'style="color:#666;"';
    }
} //S'il n'est pas connecté
else
{
        $ico_mess = '<img src="/images/oldicon-annonce.png" alt="Pas de nouveau message" title="Pas de nouveau message" />';
        $newpost = 'style="color:#666;"';
}
$topicurl=nettoyage($queryTopic['topic_titre']);
echo'<div class="forum-row"><div class="forum-main"><div style="display:table;">'.$ico_mess.'';
        $nombreDeMessagesParPage = 15;
        $nbr_post = $queryTopic['topic_post'];
        $nombreDePages = ceil($nbr_post / $nombreDeMessagesParPage);
        $page = 0;
            echo'<div class="forum-infos"><u '.$newpost.'>'.$queryTopic['topic_genre'].' :</u> <a '.$newpost.' href="./topic-'.$queryTopic['topic_id'].'-1-'.$topicurl.'.html">'.stripslashes(htmlspecialchars($queryTopic['topic_titre'])).'</a>
            <br>Pages : ';

        echo get_list_page($page, $nombreDePages, './topic-'.$queryTopic['topic_id'].'-', $topicurl); 

echo'</div></div></div>';
                echo'<div class="rept">'.$queryTopic['topic_post'].' réponses</div>

            <div class="categoForum derniermessage"><a href="./profil-'.$queryTopic['post_createur'].'.html"><img src="'.$queryTopic['membre_avatar'].'" alt="Avatar membre" title="Avatar membre" style="border-radius:50%;" width="40" /></a>
            <div class="derniermessageInfos">Dernier message par <a href="./profil-'.$queryTopic['post_createur'].'.html" style="color:'.$queryTopic['ma_membre_couleur'].';">'.stripslashes(htmlspecialchars($queryTopic['membre_pseudo_last_posteur'])).'</a><br />';
            if (date('d/m/Y',$queryTopic['post_time'])==date('d/m/Y',time())) { echo'Aujourd\'hui à '.date('H:i',$queryTopic['post_time']).''; }
            elseif (date('d/m/Y',$queryTopic['post_time'])==date('d/m/Y',strtotime("yesterday"))) { echo'Hier à '.date('H:i',$queryTopic['post_time']).''; } else {
         $m = date('n',$queryTopic["post_time"]);
         echo'Le '.date('d',$queryTopic["post_time"]) .' ' . getMinMonth($m) .' '. date('Y',$queryTopic["post_time"]) .' à '. date('H:i',$queryTopic["post_time"]) .''; }
            echo'</div></div></div>';
        }
}

//On prend tout ce qu'on a sur les topics normaux du forum
//Premièrement, sélection des champs
$add1 = 'tv_id,'; 
//Deuxièmement, jointure
$add2 = 'LEFT JOIN forum_topic_view ON forum_topic.topic_id = forum_topic_view.tv_topic_id AND forum_topic_view.tv_id = :id';
$queryMess=$db->prepare('SELECT forum_topic.topic_id, topic_titre, topic_createur, topic_vu, topic_post, topic_time, topic_last_post, topic_locked,
Mb.membre_pseudo AS membre_pseudo_createur, post_createur, post_time, Ma.membre_pseudo AS membre_pseudo_last_posteur, tv_topic_id, 
'.$add1.' post_id, Mb.membre_couleur AS mb_membre_couleur, Ma.membre_couleur AS ma_membre_couleur, Ma.membre_avatar AS membre_avatar FROM forum_topic 
LEFT JOIN forum_membres Mb ON Mb.membre_id = forum_topic.topic_createur
LEFT JOIN forum_post ON forum_topic.topic_last_post = forum_post.post_id
LEFT JOIN forum_membres Ma ON Ma.membre_id = forum_post.post_createur
'.$add2.'
WHERE topic_genre <> "Annonce" AND forum_topic.forum_id = :forum 
ORDER BY topic_last_post DESC LIMIT :premier ,:nombre');
$queryMess->bindValue(':forum',$forum,PDO::PARAM_INT);
$queryMess->bindValue(':premier',$premierMessageAafficher,PDO::PARAM_INT);
$queryMess->bindValue(':nombre',$nombreDeMessagesParPage,PDO::PARAM_INT);
$queryMess->bindValue(':id',$id,PDO::PARAM_INT);
$queryMess->execute();

if ($queryMess->rowCount()>0) {
	        //On lance la boucle
	   while ($queryTopic = $queryMess->fetch())
       {
//Gestion de l'image à afficher
if ($id!=0)
{
    if ($queryTopic['tv_id'] == $id && $queryTopic['tv_topic_id'] == $queryTopic['topic_id']) //S'il a pas lu le topic
    {
        $ico_mess = '<img src="/images/newicon.png" alt="Nouveau message" title="Nouveau message" />';
        $newpost = 'class="forumNonLu"';
        }
        else //S'il a  lu le topic
        {
        $ico_mess = '<img src="/images/oldicon.png" alt="Pas de nouveau message" title="Pas de nouveau message" />';
        $newpost = 'style="color:#666;"';
        }
    } //S'il n'est pas connecté
    else
    {
        $ico_mess = '<img src="/images/oldicon.png" alt="Pas de nouveau message" title="Pas de nouveau message" />';
        $newpost = 'style="color:#666;"';

    }
$topicurl=nettoyage($queryTopic['topic_titre']);
echo'<div class="forum-row"><div class="forum-main"><div style="display:table;">'.$ico_mess.'';
		$nombreDeMessagesParPage = 15;
		$nbr_post = $queryTopic['topic_post'];
        $nombreDePages = ceil($nbr_post / $nombreDeMessagesParPage);
        $page = 0;
            echo'<div class="forum-infos"><a '.$newpost.' href="./topic-'.$queryTopic['topic_id'].'-1-'.$topicurl.'.html">'.stripslashes(htmlspecialchars($queryTopic['topic_titre'])).'</a>
            <br>Pages : ';

        echo get_list_page($page, $nombreDePages, './topic-'.$queryTopic['topic_id'].'-', $topicurl); 

echo'</div></div></div>';
                echo'<div class="rept">'.$queryTopic['topic_post'].' réponses</div>

            <div class="categoForum derniermessage"><a href="./profil-'.$queryTopic['post_createur'].'.html"><img src="'.$queryTopic['membre_avatar'].'" alt="Avatar membre" title="Avatar membre" style="border-radius:50%;" width="40" /></a>
            <div class="derniermessageInfos">Dernier message par <a href="./profil-'.$queryTopic['post_createur'].'.html" style="color:'.$queryTopic['ma_membre_couleur'].';">'.stripslashes(htmlspecialchars($queryTopic['membre_pseudo_last_posteur'])).'</a><br />';
            if (date('d/m/Y',$queryTopic['post_time'])==date('d/m/Y',time())) { echo'Aujourd\'hui à '.date('H:i',$queryTopic['post_time']).''; }
            elseif (date('d/m/Y',$queryTopic['post_time'])==date('d/m/Y',strtotime("yesterday"))) { echo'Hier à '.date('H:i',$queryTopic['post_time']).''; } else {
         $m = date('n',$queryTopic["post_time"]);
         echo'Le '.date('d',$queryTopic["post_time"]) .' ' . getMinMonth($m) .' '. date('Y',$queryTopic["post_time"]) .' à '. date('H:i',$queryTopic["post_time"]) .''; }
            echo'</div></div></div>';

        }
        echo'</div></div>';
        }
else //S'il n'y a pas de message
{
        echo'<p>Ce forum ne contient aucun sujet actuellement</p>';
}
include("includes/fin.php");
?>
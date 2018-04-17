<?php
session_start();
$titre = "Planète Toad &bull; Voir le forum";
$descrip = "Le forum de Planète Toad sert à parler dans des sujets répartis dans différents sous-forums qui sont répartis eux-mêmes dans différentes catégories. Si le sujet dont vous voulez aborder n'existe pas, alors créez-le.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./forum.html">Forum</a></div>
<br><h1>Forum</h1>
<?php
if ($id!=0) {
echo'<br><div style="margin-left:5px;"><a href="/sujets_lus.html" style="background-color:#19af5d;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">done_all</i> Marquer tous les sujets comme lus</a></div><br><br>';
}
echo'<div class="allforum">';
//Initialisation de deux variables
$totaldesmessages = 0;
$categorie = NULL;
$dernierForum = NULL; //POUR CORRIGER LE BUG DES FORUMS MULTIPLES

    //Premièrement, sélection des champs
    $add1 = 'tv_forum_id, tv_id'; 
    //Deuxièmement, jointure
    $add2 = 'LEFT JOIN forum_topic_view ON forum_topic.forum_id = forum_topic_view.tv_forum_id AND forum_topic_view.tv_id = :id';

//Cette requête permet d'obtenir tout sur le forum
$query=$db->prepare('SELECT cat_id, cat_nom, color, 
forum_forum.forum_id, forum_name, forum_desc, forum_post, forum_topic, auth_view, url, forum_topic.topic_id, forum_topic.topic_titre, forum_topic.topic_last_post, forum_topic.topic_post, post_id, post_time, post_createur, membre_pseudo, 
membre_id, membre_avatar, membre_couleur, '.$add1.'
FROM forum_categorie
LEFT JOIN forum_forum ON forum_categorie.cat_id = forum_forum.forum_cat_id
LEFT JOIN forum_post ON forum_post.post_id = forum_forum.forum_last_post_id
LEFT JOIN forum_topic ON forum_topic.topic_id = forum_post.topic_id
LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur
'.$add2.'
WHERE auth_view <= :lvl 
ORDER BY cat_ordre, forum_ordre DESC');
$query->bindValue(':lvl',$lvl,PDO::PARAM_INT);
$query->bindValue(':id',$id,PDO::PARAM_INT);
$query->execute();
//Début de la boucle
while($data = $query->fetch())
{
    //On affiche chaque catégorie
    if($categorie!=$data['cat_id'] )
    {
        echo'</div>';
        //Si c'est une nouvelle catégorie on l'affiche
        $categorie = $data['cat_id'];
        echo'<div class="allcat"><div class="cattitle" style="background-color:'.$data['color'].';">
        <strong>'.stripslashes(htmlspecialchars($data['cat_nom'])).'</strong></div>';  
    }
    
    if($dernierForum == $data['forum_id']) continue; //BUG DE DUPLICATION DU FORUM : Passe le forum actuel s'il a déjà été ajouté
    $dernierForum = $data['forum_id'];

    //Gestion de l'image à afficher
    if ($id!=0) // Si le membre est connecté
    {
        if ($data['tv_id'] == $id && $data['tv_forum_id'] == $data['forum_id']) //S'il a pas lu le forum
        {
        $ico_mess = '<img src="/images/newicon.png" />';
        $newpost = 'class="forumNonLu"';
        }
        else //S'il a  lu le topic
        {
        $ico_mess = '<img src="/images/oldicon.png" />';
        $newpost = 'style="color:#666;"';
        }
    } //S'il n'est pas connecté
    else
    {
        $ico_mess = '<img src="/images/oldicon.png" />';
        $newpost = 'style="color:#666;"';

    }
    
    echo'<div class="forum-row"><div class="forum-main"><a href="./forum-'.$data['forum_id'].'-'.$data['url'].'.html" style="display:table;">'.$ico_mess.'
    <div class="forum-infos"><strong '.$newpost.'>'.stripslashes(htmlspecialchars($data['forum_name'])).'</strong>
    <br><i>'.nl2br(stripslashes(htmlspecialchars($data['forum_desc']))).'</i></div></a></div>
    <div class="nbrsm">'.$data['forum_topic'].' topics
    <br> '.$data['forum_post'].' messages</div>';

    // Deux cas possibles :
    // Soit il y a un nouveau message, soit le forum est vide
    if (!empty($data['forum_post']))
    {
         //Selection dernier message
        $nombreDeMessagesParPage = 15;
        $nbr_post = $data['topic_post'];
        $page = ceil($nbr_post / $nombreDeMessagesParPage);
        $topicurl=nettoyage($data['topic_titre']);

         echo'<div class="categoForum derniermessage">
         <a href="./profil-'.$data['membre_id'].'.html"><img src="'.$data['membre_avatar'].'" alt="Avatar membre" title="Avatar membre" style="border-radius:50%;" width="50" /></a>';
         echo '<div class="derniermessageInfos"><a href="./topic-'.$data['topic_id'].'-1-'.$topicurl.'.html" style="text-align:center;">'; 
         if (strlen($data['topic_titre'])<=30) { echo stripslashes(htmlspecialchars($data['topic_titre'])); } 
         else { echo substr(stripslashes(htmlspecialchars($data['topic_titre'])), 0, 30).'...'; } echo'</a><br>
         <a href="./profil-'.stripslashes(htmlspecialchars($data['membre_id'])).'.html" style="font-weight:normal;">par</a> <a href="./profil-'.stripslashes(htmlspecialchars($data['membre_id'])).'.html" style="color:'.$data['membre_couleur'].'">'.$data['membre_pseudo'].'</a>
         <span style="text-align:center;"><a href="./topic-'.$data['topic_id'].'-'.$page.'-'.$topicurl.'.html#p_'.$data['topic_last_post'].'">
         <img src="./images/go.png" alt="go" /></a></span><br>';
         if (date('d/m/Y',$data['post_time'])==date('d/m/Y',time())) { echo'Aujourd\'hui à '.date('H:i',$data['post_time']).''; }
         elseif (date('d/m/Y',$data['post_time'])==date('d/m/Y',strtotime("yesterday"))) { echo'Hier à '.date('H:i',$data['post_time']).''; } else {
         $m = date('n',$data["post_time"]);
         echo'Le '.date('d',$data["post_time"]) .' ' . getMinMonth($m) .' '. date('Y',$data["post_time"]) .' à '. date('H:i',$data["post_time"]) .''; }
         echo'</div></div></div>';
     } else {
     echo'<div class="nombremessages">Pas de message</div>'; }
//On ferme notre boucle et nos balises
} //fin de la boucle
echo'</div>';
include("includes/fin.php");
?>
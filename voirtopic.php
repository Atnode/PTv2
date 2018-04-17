<?php
session_start();
$topic = (int) $_GET['t'];
include("includes/identifiants.php");
$reponse = $db->query('SELECT topic_titre FROM forum_topic WHERE topic_id=' . $topic . ''); 
$donnees = $reponse->fetch();
$titre =  '' . $donnees['topic_titre'] . '';
$balises = true;
$colorJ = 0;
$choix_color = 0;
$experience = 0;
include("includes/debut.php");
include("includes/bbcode.php");

//verif post
$clc1 = $db->prepare('SELECT COUNT(*) AS nombre1 FROM forum_post WHERE topic_id = '.$topic.'');
$clc1->execute() or die(print_r($clc1->errorInfo()));
$nbrpost = $clc1->fetch();
$actua5=$db->prepare('UPDATE forum_topic SET topic_post = '.$nbrpost['nombre1'].' WHERE topic_id = '.$topic.'');
$actua5->execute() or die(print_r($actua5->errorInfo()));

//A partir d'ici, on va compter le nombre de messages pour n'afficher que les 15 premiers
$query=$db->prepare('SELECT * FROM forum_topic LEFT JOIN forum_forum ON forum_topic.forum_id = forum_forum.forum_id WHERE topic_id = :topic');
$query->bindValue(':topic',$topic,PDO::PARAM_INT);
$query->execute();
//On vérifie que la requête a bien retourné des messages
if ($query->rowCount()<1) { header('Location: erreur_403.html'); } else {
$data1=$query->fetch();
if ($data1['auth_view']>$lvl) { header('Location: erreur_403.html'); }
$forum=$data1['forum_id']; 
$totalDesMessages = $data1['topic_post'];
$nombreDeMessagesParPage = 15;
$nombreDePages = ceil($totalDesMessages / $nombreDeMessagesParPage);
$page = (isset($_GET['page']))?intval($_GET['page']):1;
$topicurl=nettoyage($data1['topic_titre']);
// Mauvaise URL
if (stripos($_SERVER['REQUEST_URI'], $topicurl) === FALSE) {
header("Status: 301 Moved Permanently", false, 301);
header("Location: /topic-".$topic."-1-".$topicurl.".html");
exit(); }

include("includes/menu.php");
echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./forum.html">Forum</a> -->
<a href="./forum-'.$forum.'-'.$data1['url'].'.html">'.stripslashes(htmlspecialchars($data1['forum_name'])).'</a>
 --> <a href="./topic-'.$topic.'-1-'.$topicurl.'.html">'.stripslashes(htmlspecialchars($data1['topic_titre'])).'</a></div><br>';
echo '<h1>'.stripslashes(htmlspecialchars($data1['topic_titre'])).'</h1><br><br>';
//Nombre de pages
$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
if ($id!=0 AND $data1['forum_id']!=11) {
//On affiche l'image nouveau topic
echo'<div style="float:left;"><a href="./poster.php?action=nouveautopic&amp;f='.$data1['forum_id'].'">
<img src="./images/nouveau.png" alt="Nouveau topic" title="Poster un nouveau topic" /></a>
&nbsp; <a href id="rep_topic"><img src="./images/repondre.png" alt="Répondre au topic" title="Répondre au topic" /></a></div>'; }

//On affiche les pages 1-2-3 etc...
echo '<ul class="pagination modal-4" style="float:right;">';
echo get_list_page_MDesign($page, $nombreDePages, './topic-'.$topic.'-', $topicurl); 
echo'</ul><div class="clearboth"></div><br><br><br>';

if ($id!=0) {
$query=$db->prepare('DELETE FROM forum_topic_view WHERE tv_id = :id AND tv_topic_id = :topic');
$query->bindValue(':id',$id,PDO::PARAM_INT);
$query->bindValue(':topic',$topic,PDO::PARAM_INT);
$query->execute();
}
//Enfin on commence la boucle !
$query=$db->prepare('SELECT * FROM forum_post LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur
WHERE topic_id =:topic ORDER BY post_id LIMIT :premier, :nombre');
$query->bindValue(':topic',$topic,PDO::PARAM_INT);
$query->bindValue(':premier',(int) $premierMessageAafficher,PDO::PARAM_INT);
$query->bindValue(':nombre',(int) $nombreDeMessagesParPage,PDO::PARAM_INT);
$query->execute() or die(print_r($query->errorInfo()));
        while ($data = $query->fetch())
        {
    // Si quelqu'un cite notre pseudo on le met en couleur
    /*if ($id!=0) {
    $data['post_texte'] = str_replace($pseudo, "[b][couleur=".$couleur."]".$pseudo."[/couleur][/b]", $data['post_texte']);
    $data['post_texte'] = preg_replace('`\[couleur=(.+)\](.*)\[/couleur\]`isU',"[couleur=$1]$2$3$4[/couleur]",$data['post_texte']);
    $data['post_texte'] = preg_replace('`\[b\](.*)\[b\](.*)\[/b\](.*)\[/b\]`isU',"[b]$1$2$3[/b]",$data['post_texte']);
    }*/

//On commence à afficher le pseudo du créateur du message :
         echo'<div id="p_'.$data['post_id'].'" class="commentaires"'; if(isset($data['article3_color'])) { echo'style="background-color:'.$data['article3_color'].';"'; } echo'>';
       // if (!empty($data['last_edition'])) {
       //  echo'&nbsp; <span style="color:grey;font-size:11px">Dernière édition ';
         //  if (date('d/m/Y',$data['last_edition'])==date('d/m/Y',time())) { 
           //   echo'aujourd\'hui à '.date('H:i:s',$data['last_edition']).''; }
             // else {
               // $m = date('n',$data["last_edition"]);
                //echo'le '.date('d',$data["last_edition"]) .' ' . getMonth($m) .' '. date('Y',$data["last_edition"]) .' à '. date('H:i',$data["last_edition"]) .'';
              //}
              //echo'</span>';
         //}

      $membreExistant = $db->prepare('SELECT membre_pseudo FROM forum_membres WHERE membre_id=' . $data['membre_id'] . '');
      $membreExistant->execute();
      if ($membreExistant->rowCount()<1) { // Si le membre existe pas
      echo'<br><div><div class="left-msg"><strong>
         <i>Membre supprimé</i></strong><br>

         <span style="text-align:center;display:block;"><img src="images/avadefaut.png" alt="avatar" style="max-width:150px; max-height:150px; border-radius: 50%;" /></span><br></div>';
      } else { // SI le membre existe
      echo'<br><div><div class="left-msg"><strong>
         <a href="./profil-'.$data['membre_id'].'.html" style="color:'.$data['membre_couleur'].'">
         '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a></strong>';

         $rangReq = $db->prepare('SELECT * FROM rangs WHERE tchampi_min <= '.$data['champi_total'].' AND tchampi_max >='.$data['champi_total'].'');
         $rangReq->execute();
         $rang = $rangReq->fetch();



         //POUR CALCULER L'XP     
         $calcul1 = $rang['tchampi_max'] - $rang['tchampi_min'];
         $calcul2 = $data['champi_total'] - $rang['tchampi_min'];
         if ($calcul1==0)
		 {$calcul3=0;}
		else {
	  $calcul3 = $calcul2 / $calcul1 * 100; }
         
         if ($calcul3<10) { $experience = substr($calcul3, 0, 1); } else { $experience = substr($calcul3, 0, 2); }

         // COULEUR JAUGE
            $choix_color = array('', '#1f671b', '#fba026', '#f37934', '#fac51c', '#9365b8', '#553982', '#00a885');
    if (isset ($data['article4_color']))
        $colorJ = $choix_color[$data['article4_color']];
    else
        $colorJ = $choix_color[0];

         //Détails sur le membre qui a posté
         echo'
         <div><br><div style="text-align:center;">
         <img src="'.$rang['name'].'" alt="Rang du membre" width="200" height="33" />';

         echo'</div></div><span style="text-align:center;display:block;"><a href="./profil-'.$data['membre_id'].'.html">
         <div class="c100 p'.$experience.' orange">
                    <div class="slice">
                        <div class="bar" style="border-color: '.$colorJ.'!important;"></div>
                        <div class="fill" style="border-color: '.$colorJ.'!important;"></div>
                    </div>
                    <img src="'.$data['membre_avatar'].'" alt="avatar" style="width:150px;height:150px; border-radius: 50%;margin:14px 25px 37px 15px;" />
                </div></a></span>
         <br><div class="bulleinfos"><b>Inscription :</b> '.date('d/m/Y',$data['membre_inscrit']).'
         <br><b>Messages :</b> '.$data['membre_post'].'
         <br><b>Champis :</b> '.$data['membre_champi'].'</div></div>';
     }
         echo'<div class="right-msg"><div style="padding:3px;">'.code(nl2br(stripslashes(htmlspecialchars($data['post_texte'])))).'</div><br><br>';


         if (!empty($data['membre_signature'])) {
         echo'<hr>'.code(nl2br(stripslashes(htmlspecialchars($data['membre_signature'])))).'';
		 }
		 echo'</div><div class="clearboth"></div><br><hr>';

//Modérer le message
$m = date('n',$data["post_time"]);
echo'<div style="padding:8px;"> Posté le '.date('d',$data["post_time"]) .' ' . getMinMonth($m) .' '. date('Y',$data["post_time"]) .' à '. date('H:i',$data["post_time"]) .' &nbsp;
<span style="float:right;">';
if ($lvl>1) {
$messageQuote = $data['post_texte'];
$messageQuote = str_replace("\n", "<br>", $messageQuote);
$messageQuote = str_replace("\r\n", "<br>", $messageQuote);
$messageQuote = str_replace("\r", "<br>", $messageQuote);
echo'<span onclick="address(\''.str_replace("'","\\'", htmlspecialchars(stripslashes($data['membre_pseudo']))) .'\',\''.str_replace("'","\\'", htmlspecialchars(stripslashes($messageQuote))).'\'); return false;" style="cursor:pointer;background-color:#8f41af;font-weight:bold;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">&#xE244;</i> Citer</span>&nbsp; &nbsp; ';
}
if ($lvl>3) {
echo'<a href="./poster.php?p='.$data['post_id'].'&amp;action=edit" style="background-color:#19af5d;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">&#xE254;</i> Editer</a>
&nbsp; &nbsp;<a href="./poster.php?p='.$data['post_id'].'&amp;action=delete" style="background-color:#c33925;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">delete_forever</i> Supprimer</a>
&nbsp; <a style="float:right;" href="#p_'.$data['post_id'].'">#'.$data['post_id'].'</a>
    </div><div class="clearboth"></div><br><br>';
} else if ($id == $data['post_createur']) {
echo'<span style="float:right;"><a href="./poster.php?p='.$data['post_id'].'&amp;action=edit" style="background-color:#19af5d;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">&#xE254;</i> Editer</a></span><a style="float:right;" href="#p_'.$data['post_id'].'">#'.$data['post_id'].'</a>
&nbsp; <a style="float:right;" href="#p_'.$data['post_id'].'">#'.$data['post_id'].'</a></div>';
         } else {
         echo'<a style="float:right;" href="#p_'.$data['post_id'].'">#'.$data['post_id'].'</a></div>';
         }

         echo'</span></div></div>';
         } //Fin de la boucle

        echo '<br><hr>
        <ul class="pagination modal-4" style="float:left;">';

        $pagePrev = $page - 1;
        $pageNext = $page + 1;
        if ($page != "1") { echo'<li><a href="topic-'.$topic.'-'.$pagePrev.'-'.$topicurl.'.html" class="prev"><i class="material-icons md-18">keyboard_arrow_left</i> Précédent</a></li>'; } // Page précédente si on est pas sur la first
        for ($i = 1 ; $i <= $nombreDePages ; $i++)
        {
    if ($i == $page) //On ne met pas de lien sur la page actuelle
    {
        echo '<li><a href="topic-'.$topic.'-'.$i.'-'.$topicurl.'.html" class="active">'.$i.'</a></li>';
    }
    else
    {
        echo '<li><a href="topic-'.$topic.'-'.$i.'-'.$topicurl.'.html">'.$i.'</a></li>';
    }
        }
if ($page != $nombreDePages) { echo'<li><a href="topic-'.$topic.'-'.$pageNext.'-'.$topicurl.'.html" class="next">Suivante <i class="material-icons md-18">keyboard_arrow_right</i></a></li>'; } // Page après si on é pas sur la last

echo'</ul>';

        if ($id!=0) { // bouton pour suivre le topic
        $reqFollowTopic = $db->prepare('SELECT * FROM topics_suivis WHERE id_membre = '.$id.' AND id_topic = '.$topic.'');
        $reqFollowTopic->execute();
        if ($reqFollowTopic->rowCount()==0) { // Topic pas encore suivi
          echo'<div style="float:right;margin-right:5px;"><a href="/action/follow-topic-'.$topic.'.html" style="float:right;background-color:#d65400;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">&#xE7F7;</i> Suivre ce topic</a></div>';
        } else { // topic déjà suivi
          echo'<div style="float:right;margin-right:5px;"><a href="/action/unfollow-topic-'.$topic.'.html" style="float:right;background-color:#e97f0a;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">&#xE7F6;</i> Ne plus suivre ce topic</a></div>';
        }
        }

echo'<div class="clearboth"></div>
<br><br><br>';
$query=$db->prepare('SELECT * FROM forum_topic WHERE topic_id = '.$topic.'');
$query->execute();
$data1 = $query->fetch();
if ($data1['topic_locked'] == 0 AND $id!=0) // Topic non verrouillé !
{
?>
<h2>Poster une réponse</h2>

<form method="post" action="action/rrepondre-topic.php?t=<?php echo $topic ?>" name="formulaire">
<div id="answer_topic" style="text-align:center;">
<?php include("code.php") ?>
<div style="margin-top:10px;"></div>
<b>Message :</b><br><textarea cols="80" rows="8" id="message" name="message"></textarea>
<br>
<input type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="Envoyer" /></div></form><br> <?php
}

$query = $db->prepare('SELECT topic_locked FROM forum_topic WHERE topic_id = :topic');
$query->bindValue(':topic',$topic,PDO::PARAM_INT);
$query->execute();
$data=$query->fetch();
if ($lvl>3) 
{
if ($data['topic_locked'] == 1) {
    echo'<a href="./postok.php?action=unlock&t='.$topic.'" style="background-color:#9c57b8;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">&#xE898;</i> Déverrouiller ce sujet</a>';
} else {
    echo'<a href="./postok.php?action=lock&t='.$topic.'" style="background-color:#8f41af;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"><i class="material-icons md-18">&#xE899;</i> Verrouiller ce sujet</a>';}
}
$selectForum=$db->prepare('SELECT forum_id, forum_name FROM forum_forum WHERE forum_id <> :forum');
$selectForum->bindValue(':forum',$forum,PDO::PARAM_INT);
$selectForum->execute();

if ($lvl>3) 
{
echo'<br><hr><p>Déplacer vers :
<form method="post" action=postok.php?action=deplacer&amp;t='.$topic.'>
<select name="dest">';
while($data1=$selectForum->fetch())
{
     echo'<option value='.$data1['forum_id'].' id='.$data1['forum_id'].'>'.$data1['forum_name'].'</option>';
}
echo'
</select>
<input type="hidden" name="from" value='.$forum.'>
<input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="submit" value="Envoyer" /></p><hr>
<br /> <b><a href="/postok.php?action=delete_topic&amp;t='.$topic.'">Supprimer le topic</a></b>
</form>';
}
} //Fin du if qui vérifiait si le topic contenait au moins un message
?>
<script>function address(e, text) {
    var t = document.getElementById("message"),
        o = t.value,
    remplacer = /<br>/gi,    
    text = text.replace(remplacer,"\n"),
    text = text.replace(remplacer,"\r\n"),
    text = text.replace(remplacer,"\r");
    t.value = "[quote auteur="+e+"]"+text+"[/quote] " + o, t.focus(), t.selectionStart = t.value.length
}
$("#rep_topic").on("click",function(o){o.preventDefault();var t=$("#answer_topic");t.show().find("textarea").focus(),$("body").scrollTop(t.offset().top-100)});</script>
<?php include("includes/fin.php");
?>
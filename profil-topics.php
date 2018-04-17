<?php
session_start();
  $membre = isset($_GET['m'])?(int) $_GET['m']:'';
  $topicsMembre = 1;
  include("includes/identifiants.php");
  $reponse = $db->prepare('SELECT membre_pseudo FROM forum_membres WHERE membre_id= '.$membre.'');
  $reponse->execute();
  $donnees = $reponse->fetch();
  $titre =  'Planète Toad &bull; Topics de ' . $donnees['membre_pseudo'] . '';
  $descrip = 'Consulter les topics crées par le membre '.$donnees['membre_pseudo'].' sur le site Planète Toad';
  include("includes/debut.php");
  include("includes/menu.php");
  include("includes/headerprofil.php");

  //On récupère les infos du profil à voir
  $query=$db->prepare('SELECT * FROM forum_membres WHERE membre_id = :membre');
  $query->bindValue(':membre',$membre, PDO::PARAM_INT);
  $query->execute();
  $data=$query->fetch();
  if ($query->rowCount()>0) {
    echo '<div class="corps" style="margin-top:-12.999px;"><br><h1>Topics de '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</h1>
       <br>';
    // TOPICS
    $selectTopic = $db->prepare('SELECT * FROM forum_topic LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id WHERE topic_createur = :membre AND auth_view <= :lvl ORDER by forum_name');
    $selectTopic->bindValue(':membre',$membre, PDO::PARAM_INT);
    $selectTopic->bindValue(':lvl',$lvl, PDO::PARAM_INT);
    $selectTopic->execute();

    if ($selectTopic->rowCount()<1) { echo '<p style="text-align:center;">Ce membre n\'a crée aucun topic.</p>'; } else {
     echo'<br>Ce membre a crée <strong>'.$selectTopic->rowCount().'</strong> topics.<br><br><table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"><thead>
       <tr>
       <th style="width:50px;" class="mdl-data-table__cell--non-numeric">TOPIC</th>
       <th style="width:100px;" class="mdl-data-table__cell--non-numeric">FORUM</th>
       <th style="width:100px;">Réponses</th>
       </tr></thead>';
     while ($topic = $selectTopic->fetch()) {
      $topicurl=nettoyage($topic['topic_titre']);
      echo'<tr>
      <td class="mdl-data-table__cell--non-numeric"><a href="./topic-'.$topic['topic_id'].'-1-'.$topicurl.'.html">
          '.stripslashes(htmlspecialchars($topic['topic_titre'])).'</a></td>
         <td class="mdl-data-table__cell--non-numeric"><a href="./forum-'.$topic['forum_id'].'-'.$topic['url'].'.html">
          '.stripslashes(htmlspecialchars($topic['forum_name'])).'</a></td>
         <td>'.$topic['topic_post'].'</td></tr>';
     }
     echo'</table>';
    }
  }
include("includes/fin.php");
?>
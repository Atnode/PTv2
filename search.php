<?php
session_start();
include("includes/identifiants.php");
include("includes/functions.php");
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;

if (isset($_POST['keyword'])) { // On commence la recherche
$user_search = $_POST['keyword'];
 
 // Sur les membres
 $query = $db->prepare("SELECT * FROM forum_membres WHERE membre_pseudo LIKE '%".$user_search."%' ORDER BY membre_pseudo");
 $query->execute();
 if ($query->rowCount()>0) {
 echo'<span style="font-weight:bold;font-size:14px;">Membre(s) :</span><br><br>';
  while ($data=$query->fetch()) {
   echo'<a href="./profil-'.$data['membre_id'].'.html" style="color:'.$data['membre_couleur'].'">
        '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a><br><br>';
  }
 }

 // Sur les topics
 $query = $db->prepare("SELECT * FROM forum_topic LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id WHERE topic_titre LIKE '%".$user_search."%'  AND auth_view <= ".$lvl." ORDER BY topic_id");
 $query->execute();
 if ($query->rowCount()>0) {
 echo'<br><hr><br><span style="font-weight:bold;font-size:14px;">Topic(s) :</span><br><br>';
  while ($data=$query->fetch()) {
  	$topicurl=nettoyage($data['topic_titre']);
   echo'<a href="./topic-'.$data['topic_id'].'-1-'.$topicurl.'.html">'.$data['forum_name'].' - '.stripslashes(htmlspecialchars($data['topic_titre'])).'</a><br><br>';
  }
 }

 // Sur les personnages
 $query = $db->prepare("SELECT * FROM personnages WHERE valide = '1' AND nom_perso LIKE '%".$user_search."%' ORDER BY nom_perso");
 $query->execute();
 if ($query->rowCount()>0) {
 echo'<br><hr><br><span style="font-weight:bold;font-size:14px;">Personnage(s) :</span><br><br>';
  while ($data=$query->fetch()) {
   echo'<a href="./personnage-'.$data['id'].'-'.$data['nom_url'].'.html">'.stripslashes(htmlspecialchars($data['nom_perso'])).'</a><br><br>';
  }
 }

 // Sur les objets
 $query = $db->prepare("SELECT * FROM objets WHERE valide = '1' AND nom_objet LIKE '%".$user_search."%' ORDER BY nom_objet");
 $query->execute();
 if ($query->rowCount()>0) {
 echo'<br><hr><br><span style="font-weight:bold;font-size:14px;">Objet(s) :</span><br><br>';
  while ($data=$query->fetch()) {
   echo'<a href="./objet-'.$data['id'].'-'.$data['nom_url'].'.html">'.stripslashes(htmlspecialchars($data['nom_objet'])).'</a><br><br>';
  }
 }

 // Sur les lieux
 $query = $db->prepare("SELECT * FROM lieux WHERE valide = '1' AND nom_lieu LIKE '%".$user_search."%' ORDER BY nom_lieu");
 $query->execute();
 if ($query->rowCount()>0) {
 echo'<br><hr><br><span style="font-weight:bold;font-size:14px;">Lieu(x) :</span><br><br>';
  while ($data=$query->fetch()) {
   echo'<a href="./lieu-'.$data['id'].'-'.$data['nom_url'].'.html">'.stripslashes(htmlspecialchars($data['nom_lieu'])).'</a><br><br>';
  }
 }

 // Sur les jeux
 $query = $db->prepare("SELECT * FROM jeux WHERE nom LIKE '%".$user_search."%' ORDER BY nom");
 $query->execute();
 if ($query->rowCount()>0) {
 echo'<br><hr><br><span style="font-weight:bold;font-size:14px;">Jeu(x) :</span><br><br>';
  while ($data=$query->fetch()) {
   echo'<a href="./game-'.$data['id'].'-'.$data['nom_url'].'.html">'.stripslashes(htmlspecialchars($data['nom'])).'</a><br><br>';
  }
 }


}
?>
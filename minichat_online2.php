<?php
session_start();

$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
$ip = ip2long($_SERVER['REMOTE_ADDR']);
$Chat = 1;
$balises = true;
if ($lvl<2) header('Location: erreur_403.html'); 
include("./includes/identifiants.php");
include("./includes/bbcode.php");

$BannisChat = $db->query('SELECT id FROM bannis_chat WHERE id = '. $id .'');
if ($BannisChat->fetch() == false)
{
if ($id!=0) {
$EnLigne = $db->query('SELECT * FROM chat_online WHERE id_online = '.$id.'');
if ($EnLigne->fetch() == false)
{
  $query = $db->prepare('INSERT INTO chat_online(id_online, timestamp) VALUES(:id, :time)');
  $query->bindValue(':id',$id,PDO::PARAM_INT);
  $query->bindValue(':time',time(),PDO::PARAM_INT);
  $query->execute();
  $query->closeCursor();
} else {
  $query = $db->prepare('UPDATE chat_online SET timestamp = :time, absent = "0" WHERE id_online = :id');
  $query->bindValue(':time',time(),PDO::PARAM_INT);
  $query->bindValue(':id',$id,PDO::PARAM_INT);
  $query->execute();
  $query->closeCursor();

$time_max = time() - (60 * 5);
$query=$db->prepare('DELETE FROM chat_online WHERE timestamp < :timemax');
$query->bindValue(':timemax',$time_max,PDO::PARAM_INT);
$query->execute();
$query->closeCursor();

//S'il est absent
$absent = time() - (60 * 3);
$query = $db->prepare('UPDATE chat_online SET absent = "1" WHERE timestamp < :absent');
$query->bindValue(':absent',$absent,PDO::PARAM_INT);
$query->execute();
$query->closeCursor();
}  }
$Liste = $db->query('SELECT id_online, membre_id, membre_pseudo, membre_couleur, membre_avatar, absent FROM chat_online LEFT JOIN forum_membres ON membre_id = id_online ORDER BY timestamp DESC');
echo'<h2>Membres en ligne</h2>
<table><tbody><tr>';
while($data = $Liste->fetch()) {
	echo'<td style="padding:20px;"><a href="/profil-'.htmlentities(stripslashes($data['membre_id'])).'.html" style="color:'.htmlentities(stripslashes($data['membre_couleur'])).';">';
	if ($data['absent']=="0"){echo'<img src="'.htmlentities(stripslashes($data['membre_avatar'])).'" width="70" style="margin-right:10px;margin-bottom:-14%;border-radius:50%;border:4px solid green;" alt="avatar" title="En ligne">';}
	else{echo'<img src="'.htmlentities(stripslashes($data['membre_avatar'])).'" style="max-width:75px;margin-right:10px;margin-bottom:-14%;border-radius:50%;border:4px solid orange;" alt="avatar" title="Absent">';}
	
	echo''.htmlentities(stripslashes($data['membre_pseudo']), ENT_QUOTES, "UTF-8").'</a></td>';
    echo'</tr><tr>';
}
echo'
</tr></tbody></table>';
}
else {
        $query=$db->prepare('SELECT membre_id, membre_pseudo, membre_couleur, id_bannisseur FROM bannis_chat LEFT JOIN forum_membres ON membre_id = id_bannisseur');
        $query->execute();
        $data=$query->fetch();
echo'<p align=center><b>Vous avez été banni du chat par <span style="color:'.$data['membre_couleur'].';">'. $data['membre_pseudo'] .'</span>. Pour connaître la raison, contactez-le</p></strong>';
}

?>
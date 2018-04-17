<?php
session_start();
include("identifiants.php");

//Cookie
Header("Cache-Control: must-revalidate");
$offset = 60 * 60 * 24 * 3;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
Header($ExpStr);

if (isset($_COOKIE['id']) && isset($_COOKIE['password']))
{
$_SESSION['id'] = $_COOKIE['id'];
$_SESSION['password'] = $_COOKIE['password'];
        $query = $db->prepare('SELECT * FROM forum_membres WHERE membre_id = :id');
        $query->bindValue(':id',$_COOKIE['id'],PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch();
if ($data['membre_mdp'] == $_COOKIE['password']) // Acces OK !
{
        $_SESSION['pseudo'] = $data['membre_pseudo'];
        $_SESSION['level'] = $data['membre_rang'];
        $_SESSION['id'] = $data['membre_id'];
        $_SESSION['password'] = $data['membre_mdp'];


}
        else { 
            setcookie('id', '', time(), null, null, false);
            setcookie('password', '', time(), null, null, false);
            session_destroy();
            header('Location: erreur_403.html');
        }
}

$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

//Banni 
if ($lvl==0) {
setcookie('id', '', time(), null, null, false);
setcookie('password', '', time(), null, null, false);
session_destroy();
session_destroy();
}

if ($id!=0) {
$ip = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];

$query=$db->prepare('UPDATE forum_membres SET membre_derniere_visite = '.time().', ip = :ip, useragent = :useragent WHERE membre_id = :id');
$query->bindValue(':id',$id,PDO::PARAM_INT);
$query->bindValue(':useragent',$useragent, PDO::PARAM_STR);
$query->bindValue(':ip',$ip, PDO::PARAM_INT);
$query->execute();

//OnlineChat
$time_max = time() - (60 * 10);
$query=$db->prepare('DELETE FROM chat_online WHERE timestamp < :timemax');
$query->bindValue(':timemax',$time_max,PDO::PARAM_INT);
$query->execute();

    //MP
    $query=$db->prepare('SELECT COUNT(*) FROM mp_texte WHERE id_receveur = :id AND lu = :non');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->bindValue(':non','0',PDO::PARAM_STR);
    $query->execute();
    $new_mp=$query->fetchColumn();
    $mp_nlu = ':non';
if ($new_mp==0) {
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/mp.html" title="Messagerie Privée" style="color:white;line-height:38px;"><i class="material-icons md-18">&#xE0BE;</i></a></span>';
} else {
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/mp.html" title="Messagerie Privée" style="color:cyan;line-height:38px;"><div class="material-icons md-18 mdl-badge mdl-badge--overlap" data-badge="'.$new_mp.'">&#xE0BE;</div></a></span>';
}
    //Amis
    $query=$db->prepare('SELECT COUNT(*) FROM forum_amis
    WHERE ami_to = :id AND ami_confirm = :conf');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->bindValue(':conf','0', PDO::PARAM_STR);
    $query->execute();
    $demande_ami=$query->fetchColumn();
     $conf = ':conf';
if ($demande_ami==0) {
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/amis.html" title="Amis" style="color:white;line-height:38px;"><i class="material-icons md-18">&#xE420;</i></a></span>';
} else {
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/amis.html" title="Amis" style="color:cyan;line-height:38px;"><div class="material-icons md-18 mdl-badge mdl-badge--overlap" data-badge="'.$demande_ami.'">&#xE420;</div></a></span>';
}
  // Pour les notifs
  $searchNotifs=$db->prepare('SELECT COUNT(*) FROM notifs WHERE id_receveur = :id AND lu = :zero');
  $searchNotifs->bindValue(':id',$id,PDO::PARAM_INT);
  $searchNotifs->bindValue(':zero','0', PDO::PARAM_STR);
  $searchNotifs->execute();
  $new_notif=$searchNotifs->fetchColumn();

if ($new_notif==0) {
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/notifs.html" title="Notifications" style="color:white;line-height:38px;"><i class="material-icons md-18">&#xE7F4;</i></a></span>';
} else {
echo'<span style="float:right;"><a class="mdl-navigation__link" href="/notifs.html" title="Notifications" style="color:cyan;line-height:38px;"><div class="material-icons md-18 mdl-badge mdl-badge--overlap" data-badge="'.$new_notif.'">&#xE7F4;</div></a></span>';
}
}
?>
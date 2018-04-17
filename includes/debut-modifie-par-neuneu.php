<?php
Header("Cache-Control: must-revalidate");
$offset = 60 * 60 * 24 * 3;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
Header($ExpStr);

if (isset($_COOKIE['id']) && isset($_COOKIE['password']) && empty($id)) {
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
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
            $fakeCookie == 1;
        }
}
//Attribution des variables de session
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
 ?>
<!doctype html>
<html lang="fr">
<head>
<?php
echo '<title>'.$titre.'</title>';
if (!empty($descrip)) {echo'<meta name="description" content="'.$descrip.'">';}
if (!empty($descrip)) {echo'<meta property="og:description" content="'.$descrip.'" />';}
if (!empty($canonical)) {echo'<link rel="canonical" href="'.$canonical.'">'; }
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
echo'<meta property="og:url" content="'.$url.'" />';
?>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" lang="fr" content="Planete, Toad, Site, Forum, magnifique, univers, Mario, Nintendo, Chat, Jeux, Bonus, News, Champoad, Toaddle, découvrez, miiverse, communauté, membres, multi, bienvenue, publications, chroniques, awards, Wii U, boutique, musique, commentaire, encyclopedie, personnages, objets, transformations, retrospectives, lieux, tennindo, minichat, musee">
<meta property="fb:page_id" content="334412563411916">
<?php
if (isset($titre)) {
    echo '<meta property="og:title" content="'.$titre.'">';
} else {
    echo '<meta property="og:title" content="Planète Toad">';
}
?>
<meta property="og:site_name" content="Planète Toad" />
<meta property="og:type" content="Website" />
<?php if (!empty($og_img)) { echo'<meta property="og:image" content="'.$og_img.'" />'; } ?>
<link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
<link rel="manifest" href="/images/favicon/manifest.json">
<link rel="publisher" href="https://plus.google.com/114158430171108023491" />
<?php if (empty($_COOKIE['design']) OR $_COOKIE['design']==0) {
echo'<link rel="stylesheet" type="text/css" title="Design" href="/bleu.css" />'; }
?>
<?php if ((isset($_COOKIE['design']) && $_COOKIE['design']==1)) {
echo'<link rel="stylesheet" type="text/css" title="Design" href="/rouge.css" />'; }
if (date("H")<6 OR date("H")>21) {
echo'<style type="text/css">body{color:#000;background-attachment:fixed;background-repeat:repeat;display:none;background-image:url(/images/backgroundDay2.jpg);background-position:center;font-family:Open Sans,Verdana,Arial;font-size:12.9px;margin:0;margin-top:-1px;letter-spacing:0.2px}</style>';
} else {
echo'<style type="text/css">body{color:#000;background-attachment:fixed;background-repeat:repeat;display:none;background-image:url(/images/backgroundDay2.jpg);background-position:center;font-family:Open Sans,Verdana,Arial;font-size:12.9px;margin:0;margin-top:-1px;letter-spacing:0.2px}</style>';
}


/* nom de l ancien bg : backgroundDay2.jpg */
?>

<link rel="stylesheet" type="text/css" title="Design" href="/mobile.css" media="screen and (max-width: 850px)" />
<link rel="stylesheet" type="text/css" title="Design" href="/style.css" media="screen and (min-width: 850px)">

<?php if ((isset($_COOKIE['design']) && $_COOKIE['design']==2)) {
echo'<link rel="stylesheet" type="text/css" title="Design" href="./theme/smw/smw.css" />'; }
if ((isset($_COOKIE['design']) && $_COOKIE['design']==3)) {
echo'<link rel="stylesheet" type="text/css" title="Design" href="./theme/sm3dw/sm3dw.css" />'; }
if ((isset($_COOKIE['design']) && $_COOKIE['design']==4)) {
echo'<link rel="stylesheet" type="text/css" title="Design" href="./theme/odyssey/odyssey.css" />'; }
?>
<script src="/js/jquery.js"></script>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
<?php
//Banni 
if ($lvl==0) {
setcookie('id', '', time(), null, null, false);
setcookie('password', '', time(), null, null, false);
session_destroy();
}
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");

//Création des variables
if ($id!=0) {
$ip = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];

$query=$db->prepare('UPDATE forum_membres SET membre_derniere_visite = '.time().', ip = :ip, useragent = :useragent, membre_pageactuelle = :titre WHERE membre_id = :id');
$query->bindValue(':id',$id,PDO::PARAM_INT);
$query->bindValue(':useragent',$useragent, PDO::PARAM_STR);
$query->bindValue(':ip',$ip, PDO::PARAM_INT);
$query->bindValue(':titre',$titre, PDO::PARAM_STR);
$query->execute();
} else {
$ip = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];

$reqAct = $db->prepare('INSERT INTO online (ip, useragent, timestamp, url) VALUES (:ip, :useragent, :time, :url)');
$reqAct->bindValue(':ip',$ip, PDO::PARAM_STR);
$reqAct->bindValue(':useragent',$useragent, PDO::PARAM_STR);
$reqAct->bindValue(':time',time(), PDO::PARAM_INT);
$reqAct->bindValue(':url',$_SERVER["REQUEST_URI"], PDO::PARAM_STR);
$reqAct->execute();


$cinqmin = time() - (60 * 10);
$reqSup = $db->prepare('DELETE FROM online WHERE timestamp < '.$cinqmin.'');
$reqSup->execute();
}
?>
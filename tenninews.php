<?php
session_start();
$news = isset($_GET['titre'])?(int) $_GET['titre']:'';
include("includes/identifiants.php");
include("includes/debut.php");

// OSEF DU TENNINDO DONC REDIRECTION
$reqNews = $db->prepare('SELECT * FROM news WHERE id = '. $news .'');
$reqNews->execute();
$newsData=$reqNews->fetch();
if ($reqNews->rowCount()<1) {
header("Status: 301 Moved Permanently", false, 301);
header("Location: /erreur_404.html");
} else {
$titreurl=nettoyage($newsData['titre']);
header("Status: 301 Moved Permanently", false, 301);
header("Location: /chronique-".$news."-".$titreurl.".html");
exit();
}

?>
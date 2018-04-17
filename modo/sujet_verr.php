<?php
session_start();
$titre="Planète Toad &bull; Modération";
$balises = true;
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($lvl<4) header('Location: ../erreur_403.html'); 
include("../includes/menu.php");
$query = $db->query('SELECT * FROM forum_topic WHERE topic_locked <> 1');
$query->execute();
echo'
<h1>Panneau de modération</h1>';
while ($data = $query->fetch()) {
echo'<div style="text-align:center;">- <a href="../topic-'.$data['topic_id'].'-1.html">'.$data['topic_titre'].'</a></div>';
}
include("../includes/fin.php");
?>
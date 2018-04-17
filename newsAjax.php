<?php
session_start();

$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
$balises = true;
include("./includes/identifiants.php");
include("./includes/bbcode.php");
include("./includes/functions.php");
$news = (int) $_GET['id'];

$commentaire=$db->prepare('SELECT * FROM commentaires LEFT JOIN forum_membres ON membre_id = id_posteur WHERE id_news = '. $news .' ORDER BY timestamp DESC'); // On sélectionne les publications
$commentaire->execute();
if ($commentaire->rowCount()>0)
{
while($data = $commentaire->fetch())
{
echo'<div class="commentaires"'; if(isset($data['article3_color'])) { echo'style="background-color:'.$data['article3_color'].';"'; } echo'><table style="width:98%;"><tr>';
echo'<td style="width:85px;"><a href="/profil-'.htmlentities(stripslashes($data['membre_id'])).'.html"><img src="'.htmlentities(stripslashes($data['membre_avatar'])).'" alt="avatar" style="vertical-align:top; max-width:75px; max-height:75px; margin:3px; border-radius:50%;" /></a></td><td style="border:none;"><p>'.code(nl2br(stripslashes(htmlspecialchars($data['commentaire'])))).'</p></td>';
if ($data['id_posteur']==$id OR $lvl>3){echo'<div style="text-align:right;"><a href="./comm-suppr.php?id='.$data['id'].'" style="color:red;"><i class="material-icons">close</i></a></div>';}
echo'</tr></table>
<br><div style="text-align:right;font-style:italic;">Le '.date('d/m/Y à H:i',$data['timestamp']).' par <a href="/profil-'.htmlentities(stripslashes($data['membre_id'])).'.html" style="color:'.$data['membre_couleur'].'" itemprop="'.$data['membre_pseudo'].'">'.htmlentities(stripslashes($data['membre_pseudo']), ENT_QUOTES, "UTF-8").'</a></div></div><br />';
}
} else {
echo'<strong>Il n\'y a aucun commentaire pour cette news.</strong><hr />';
}
?>
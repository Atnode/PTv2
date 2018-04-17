<?php
session_start();
$news = isset($_GET['titre'])?(int) $_GET['titre']:'';
include("./includes/identifiants.php");
$reponse = $db->query('SELECT titre FROM news WHERE id='. $news .'');
$reponse->execute();
$donnees = $reponse->fetch();
$titre =  ''.$donnees['titre'].' &bull; Planète Toad';
$descrip = "Consulter, commenter la news nommée " . $donnees['titre'] . " sur le site Planète Toad";
$balises = true;
include("./includes/debut.php");
include("./includes/bbcode.php");

$reqNews = $db->prepare('SELECT * FROM news LEFT JOIN forum_membres ON membre_id = posteur_id WHERE id= '. $news .' AND valide = "1"');
$reqNews->execute();
$newsData=$reqNews->fetch();
if ($reqNews->rowCount()<1) {
echo'La news n\'existe pas'; } else {
$titreurl=nettoyage($newsData['titre']);
$og_img = $newsData['image'];
// Mauvaise URL
if (stripos($_SERVER['REQUEST_URI'], $titreurl) === FALSE) {
header("Status: 301 Moved Permanently", false, 301);
header("Location: /news-".$news."-".$titreurl.".html");
exit(); }

// Si c'est une chronique
if ($newsData['icon']==8 AND stripos($_SERVER['REQUEST_URI'], "chronique-") === FALSE) {
header("Status: 301 Moved Permanently", false, 301);
header("Location: /chronique-".$news."-".$titreurl.".html");
exit(); }

// Si c'est une news
if ($newsData['icon']!=8 AND stripos($_SERVER['REQUEST_URI'], "news-") === FALSE) {
header("Status: 301 Moved Permanently", false, 301);
header("Location: /news-".$news."-".$titreurl.".html");
exit(); }

include("./includes/menu.php");

// LIEN POUR LE FIL D'ARIANE
if ($newsData['icon']==8) { $typeNEWSURL = "chronique"; } else { $typeNEWSURL = "news"; }

echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./archives-news.html">News</a> -->
<a href="./'.$typeNEWSURL.'-'.$news.'-'.$titreurl.'.html">'.stripslashes(htmlspecialchars($newsData['titre'])).'</a></div><br>';
echo'<h1>'.stripslashes(htmlspecialchars($newsData['titre'])).'</h1>';
echo'<br><div style="padding-left:4px;">'.code(nl2br(stripslashes($newsData['contenu']))).'</div>';
?>
<div style="text-align:right;font-style:italic;margin:3px;"><?php if (date('d/m/Y', $newsData['timestamp'])==date('d/m/Y',time())) {
echo'Actualité publiée aujourd\'hui à '.date('H:i',$newsData['timestamp']).' par <strong><a href="/profil-'.htmlentities(stripslashes($newsData['membre_id'])).'.html" style="color:'.$newsData['membre_couleur'].'">'.htmlentities(stripslashes($newsData['membre_pseudo']), ENT_QUOTES, "UTF-8").'</a></strong>';
} else { echo'Actualité publiée le '.date('d/m/Y à H\hi', $newsData['timestamp']).' par <strong><a href="/profil-'.htmlentities(stripslashes($newsData['membre_id'])).'.html" style="color:'.$newsData['membre_couleur'].'">'.htmlentities(stripslashes($newsData['membre_pseudo']), ENT_QUOTES, "UTF-8").'</a></strong>'; } ?>
</div><br><br>
<a href="https://www.facebook.com/share.php?u=https://www.planete-toad.fr/news-<?php echo $data['id']; ?>-<?php echo $titreurl; ?>.html" target="_blank"><img src="images/logo-facebook-news.png" alt="Logo Facebook" title="Logo Facebook" width="75" height="75" /></a>
<a href="https://twitter.com/share?original_referer=https://www.planete-toad.fr/news-<?php echo $data['id']; ?>-<?php echo $titreurl; ?>.html" target="_blank"><img src="images/logo-twitter-news.png" alt="Logo Twitter" title="Logo Twitter" width="75" height="75" /></a>
<a href="https://plus.google.com/share?url=https://www.planete-toad.fr/news-<?php echo $data['id']; ?>-<?php echo $titreurl; ?>.html" target="_blank"><img src="images/logo-gplus-news.png" alt="Logo Google Plus" title="Logo Google Plus" width="75" height="75" /></a>
<?php
$reqVoirAussi = $db->prepare('SELECT * FROM news WHERE posteur_id = '.$newsData['membre_id'].' AND id != '.$news.' AND icon <> 8 ORDER BY id desc LIMIT 5');
$reqVoirAussi->execute() or die(print_r($reqVoirAussi->errorInfo()));
echo'<div class="commentaires" style="text-align:center;"><u>Voir aussi :</u><br><br>';
while($data33 = $reqVoirAussi->fetch()) {
$titreurl=nettoyage($data33['titre']);
echo'&bull; <a href="/news-'.$data33['id'].'-'.$titreurl.'.html">'.$data33['titre'].'</a><br><br>'; } ?>
</div><br><hr />
<h2>Commentaires</h2><br>
<?php
if ($lvl<2) {
echo'<div style="font-weight:bold;text-align:center;color:red;">Vous devez vous <a href="/connexion.html">connecter</a> ou vous <a href="/inscription.html">inscrire</a> pour pouvoir commenter une news.</div><hr />';
}
else 
{
	$OneMonth = time() - $newsData['timestamp'];
	if ($OneMonth<2629800) { // On vérifie si la news date de plus d'un mois
	echo '<form method="post" action="#" name="formulaire"><div style="text-align:center;">';
	include("code.php");
	echo'</div><p align=center><b>Commentaire :</b><br><textarea cols="50" rows="6" name="commenter" id="message"></textarea><br />
	<input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" id="envoyer" value="Envoyer" /></p></form><br />';
    } else {echo'<div class="commentaires" style="text-align:center;"><b>La news est trop vieille pour qu\'elle soit commentée.</b></div><br>';}
}
$query = $db->prepare('SELECT * FROM commentaires LEFT JOIN forum_membres ON membre_id = id_posteur WHERE id_news = '. $news .' ORDER BY timestamp DESC'); 
$query->execute();
if ($query->rowCount()>0)
{
    echo'<div id="commeNews">';
while($data = $query->fetch())
{
echo'<div class="commentaires"'; if(isset($data['article3_color'])) { echo'style="background-color:'.$data['article3_color'].';"'; } echo'><table style="width:98%;"><tr>';
echo'<td style="width:85px;"><a href="/profil-'.htmlentities(stripslashes($data['membre_id'])).'.html"><img src="'.htmlentities(stripslashes($data['membre_avatar'])).'" alt="avatar" style="vertical-align:top; max-width:75px; max-height:75px; margin:3px; border-radius:50%;" /></a></td><td style="border:none;"><p>'.code(nl2br(stripslashes(htmlspecialchars($data['commentaire'])))).'</p></td>';
if ($data['id_posteur']==$id OR $lvl>3){echo'<div style="text-align:right;"><a href="./comm-suppr.php?id='.$data['id'].'" style="color:red;"><i class="material-icons">close</i></a></div>';}
echo'</tr></table>
<br/><div style="text-align:right;font-style:italic;">Le '.date('d/m/Y à H:i',$data['timestamp']).' par <a href="/profil-'.htmlentities(stripslashes($data['membre_id'])).'.html" style="color:'.$data['membre_couleur'].'" itemprop="'.$data['membre_pseudo'].'">'.htmlentities(stripslashes($data['membre_pseudo']), ENT_QUOTES, "UTF-8").'</a></div></div><br />';
} echo'</div>'; // On referme AJAX
} else {
echo'<strong>Il n\'y a aucun commentaire pour cette news.</strong><hr />';
}
?>
<script type="text/javascript" async>
$(function(){function e(){var e="<?php echo $news; ?>";$("#commeNews").load("newsAjax.php?id="+e)}e(),$("#envoyer").click(function(){var n="<?php echo $news; ?>",o=$("#message").val();return $.post("comm-news.php?news="+n,{commenter:o},function(){$("#message").val(""),$("#message").focus(),e()}),!1}),document.addEventListener("keypress",function(n){if(10==n.keyCode){var o="<?php echo $news; ?>",c=$("#message").val();return $.post("comm-news.php?news="+o,{commenter:c},function(){$("#message").val(""),$("#message").focus(),e()}),!1}})});
</script>
<?php
}
include("./includes/fin.php");
?>
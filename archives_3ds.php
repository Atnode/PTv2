<?php
//Cette fonction doit être appelée avant tout code html
session_start();
$titre = "Planète Toad &bull; Archives des chroniques";
$descript = "Voir les anciennes chroniques depuis le début du site";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> Archives des chroniques</div><br />
<h1>Archive des news 3DS</h1>
<div class="archivesnews">
<?php
$retour = $db->query('SELECT * FROM news LEFT JOIN forum_membres ON membre_id = posteur_id WHERE valide = 1 AND icon = 1 ORDER BY id DESC') or die(print_r($db->errorInfo()));
$JourSemaine = null;
$Mois = null;
echo'<div style="padding-left:4px;">';
while ($donnees = $retour->fetch())
{
$titreurl=nettoyage($donnees['titre']);
echo'<br>'; ?>
<div class="news-3ds">3DS</div>
<?php if ($donnees['new']==1) {	?>
<a href="/chronique-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left: 3px;color:darkgreen"><b><?php echo $donnees['titre']; ?></b></a>
<?php } else { ?>
<a href="/chronique-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left: 3px;"><b><?php echo $donnees['titre']; ?></b></a>
<?php } ?>
<div style="float:right; margin-right:5px;">
<?php $TotalDesCommentaires = $db->query('SELECT COUNT(*) FROM commentaires WHERE id_news = '.$donnees['id'].'')->fetchColumn(); // On compte le nombre de commentaires ici
echo'&nbsp; &nbsp; &nbsp; <b>'.$TotalDesCommentaires.' com(s)</b></div><br /><br />';
}
echo'</div></div>';
include("includes/fin.php");
?>
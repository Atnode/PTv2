<?php
session_start();
$titre = "Planète Toad &bull; Archives des news";
$descript = "Voir les anciennes news depuis le début du site";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> Archives des news</div><br />
<h1>Archive des news</h1>
<div class="archivesnews">
<?php
$retour = $db->query('SELECT * FROM news LEFT JOIN forum_membres ON membre_id = posteur_id WHERE valide = 1 AND icon <> 8 ORDER BY id DESC') or die(print_r($db->errorInfo()));
$JourSemaine = null;
$Mois = null;
echo'<div style="padding-left:4px;">';
while ($donnees = $retour->fetch())
{
$titreurl=nettoyage($donnees['titre']);
$recente = time () - $donnees['timestamp'];
$choix_icon = array('site', '3ds', 'wii-u', 'multi', 'eShop', 'miiverse', 'divers', 'NTXP', '', 'Switch', 'mobile');
if (isset ($_POST['$donnees'])) $sort = $choix_icon[$_POST['$donnees']];
else $sort = $choix_icon[0];
echo'<br><div style="border-bottom:1px solid rgba(150, 150, 150, 0.28);">'; ?>
<?php $TotalDesCommentaires = $db->query('SELECT COUNT(*) FROM commentaires WHERE id_news = '.$donnees['id'].'')->fetchColumn(); // On compte le nombre de commentaires ici
if ($TotalDesCommentaires>9) { // News HOT ?>
<div style="float:left;" class="news-<?php echo $image = $choix_icon[$donnees['icon']]; ?>"><?php echo $image = $choix_icon[$donnees['icon']]; ?></div>
<a href="/news-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left:3px;color:red"><b><?php echo $donnees['titre']; ?></b></a>
<div style="float:right;margin-right:5px;">
<?php echo'&nbsp; &nbsp; &nbsp; <span style="font-weight:bold;color:red;">'.$TotalDesCommentaires.' com(s)</span></div><br><br><br></div><br>';
} else { //Fin news hot ?>
<div style="float:left;" class="news-<?php echo $image = $choix_icon[$donnees['icon']]; ?>"><?php echo $image = $choix_icon[$donnees['icon']]; ?></div>
<?php if ($recente<604800) {	?>
<a href="/news-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left: 3px;color:darkgreen"><b><?php echo $donnees['titre']; ?></b></a>
<?php } else { ?>
<a href="/news-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left: 3px;"><b><?php echo $donnees['titre']; ?></b></a>
<?php } ?>
<div style="float:right; margin-right:5px;">
<?php
echo'&nbsp; &nbsp; &nbsp; <b>'.$TotalDesCommentaires.' com(s)</b></div><br><br><br></div><br>';
}
}
echo'</div></div>';
include("includes/fin.php");
?>
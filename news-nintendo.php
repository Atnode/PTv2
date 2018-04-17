<?php
session_start();
$titre = "Planète Toad &bull; News Nintendo";
$descrip = "Découvrez sur cette page l'actualité Nintendo";
$canonical = "http://www.planete-toad.fr/";
include("includes/identifiants.php");
include("includes/bbcode.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<br><h1>News Nintendo</h1><br>

<?php
$retour = $db->prepare('SELECT * FROM news LEFT JOIN forum_membres ON membre_id = posteur_id WHERE valide = 1 AND icon <> 8 AND icon <> 0 AND icon <> 6 AND icon <> 7 ORDER BY id DESC');
$retour->execute();
echo'<div class="tableNews">';
$NNews =0;
while ($donnees = $retour->fetch())
{
	$titreurl=nettoyage($donnees['titre']);
	$recente = time () - $donnees['timestamp'];
	$choix_icon = array('', '3ds', 'wii-u', 'multi', 'eShop', 'miiverse', '', '', '', 'NX', 'mobile');
	if (isset ($_POST['$donnees']))
		$sort = $choix_icon[$_POST['$donnees']];
	else
		$sort = $choix_icon[0];
	?>
	<div class="affichNews">
		<a href="/news-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html"> 
		<?php if (!empty($donnees['image'])) {
			$dimensions = getimagesize("http://www.planete-toad.fr" . $donnees['image']);
			echo'<img src="'.$donnees['image'].'" style="margin-left:auto;margin-right:auto;" '.$dimensions[3].' title="'.$donnees['titre'].'" alt="'.$donnees['titre'].'" />';
		 } else {
        echo'<img src="/images/LOGOPT3100.png" style="margin-left:auto;margin-right:auto;" width="100" height="100" title="'.$donnees['titre'].'" alt="'.$donnees['titre'].'" />';
			 } ?>

	</a><br><br><div class="news-<?php echo $image = $choix_icon[$donnees['icon']]; ?>"><?php echo $image = $choix_icon[$donnees['icon']]; ?></div><br>
	<?php $TotalDesCommentaires = $db->query('SELECT COUNT(*) FROM commentaires WHERE id_news = '.$donnees['id'].'')->fetchColumn(); // On compte le nombre de commentaires ici
	if ($TotalDesCommentaires>9) { // News HOT ?>
		<a href="/news-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left:3px;color:red"><b><?php echo $donnees['titre']; ?></b></a><br><br>
		<?php echo'<span style="font-weight:bold;color:red;"><i class="material-icons md-18">comment</i> '.$TotalDesCommentaires.'</span>';

	} else { //Fin news hot
		if ($recente<604800) {  ?>
		<a href="/news-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left:3px;color:darkgreen"><b><?php echo $donnees['titre']; ?></b></a><br><br>
		<?php } else { ?>
		<a href="/news-<?php echo $donnees['id']; ?>-<?php echo $titreurl; ?>.html" title="news" style="margin-left:3px;"><b><?php echo $donnees['titre']; ?></b></a><br>
		<?php }
		echo'<b><i class="material-icons md-18">comment</i> '.$TotalDesCommentaires.'</b>';
	}
	echo '</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>';
	$NNews++; if($NNews==3) { echo'</div><br><div class="tableNews">'; $NNews = 0; }
}
echo'</div><br>';
include("includes/fin.php");
?>
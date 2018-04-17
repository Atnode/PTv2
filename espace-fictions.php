<?php
session_start();
$titre = "Planète Toad &bull; Espace fictions";
$descript = "L'espace des fonctions est l'endroit où les fictions les plus prestigieuses du site sont classées.";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./espace-fictions.html">Espace Fictions</a></div>
<br> <h1>Espace Fictions</h1><br>
<?php
$numberFic = 0; //Pour le choix des couleurs
$choix_color = array('#8f41af', '#d65400', '#1b7fbb', '#19af5d', '#f69d00', '#ea4c36', '#00bc9c', '#9c57b8', '#e97f0a', '#2597dd');
$query = $db->prepare('SELECT * FROM fics_index LEFT JOIN forum_membres ON forum_membres.membre_id = fics_index.id_posteur');
$query->execute();
while ($data=$query->fetch()) {
	echo'<a href="/fic-'.$data['id'].'-'.$data['url'].'.html"><table class="ludaweb01" style="width:98%;margin-left:1%;margin-right:1%;background-color:'.$choix_color[$numberFic].';"><tbody><tr><td><img src="'.$data['image'].'" style="max-width:225px;padding:5px;" alt="'.$data['titre'].'" title="'.$data['titre'].'" /></td>
	<td><span style="color:white;"><p style="font-size:18px;text-transform:uppercase;">'.$data['titre'].'</p>
	<p style="font-size:14px;">'.$data['description'].'</p></span></td>
	</tr></tbody></table></a><br><br><br>';

	$numberFic++;
}
include("includes/fin.php");
?>
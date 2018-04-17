<?php
session_start();
$titre = "Planète Toad &bull; Encyclopédie des lieux";
$descrip = "L'encyclopédie contient des fiches biographiques sur les lieux de l'univers Mario, utile si vous voulez approfondir vos connaissances ou y contribuer";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
$query=$db->prepare('SELECT COUNT(*) FROM lieux WHERE valide = "1"');
$query->execute();
$nbrfiches=$query->fetchColumn();
?>
<div id="filariane">>> <a href="./">Index</a> --> <a href="./lieux.html">Encyclopédie des lieux</a></div>
<br><h1>Lieux</h1>
<p>L'encyclopédie contient des fiches biographiques sur les lieux de l'univers Mario. Vous pouvez y contribuer en y ajoutant des fiches, en récompense, vous gagnerez des <b>Champis</b>. Pour cela, il suffit juste d'être inscrit sur Planète Toad. L'encyclopédie contient <?php echo'<b>'.$nbrfiches.'</b>';?> fiches des lieux, qui est en constante augmentation.</p><br>
<?php if ($id!=0) { echo'<a href="/add-lieu.php"><img src="./images/nouveau.png" alt="Ajouter une nouvelle fiche" title="Ajouter une nouvelle fiche" /></a>'; }
$query=$db->prepare('SELECT * FROM lieux WHERE valide= "1" ORDER BY id desc');
$query->execute() or die(print_r($query->errorInfo()));
while($data = $query->fetch()) {
	echo'<a href="/lieu-'.$data['id'].'-'.$data['nom_url'].'.html"><div class="commentaires" style="text-align:center;"><div style="float:left;">
	<img src="'.$data['image'].'" title="Image de '.$data['nom_lieu'].'" alt="Image de '.$data['nom_lieu'].'" style="max-width:200px;max-height:200px;" /></div>
	<div style="width:80%;"><b><u>'.$data['nom_lieu'].'</u></b><br><br>
	<b>Première apparition :</b> '.$data['premiere_apparition'].'<br><br>
	<b>Dernière apparition :</b> '.$data['derniere_apparition'].'<br><br>
	<b>Alias :</b> '.$data['alias'].'<br><br>
    >>Plus d\'infos ici &lt;&lt;</div><div class="clearboth"></div></div></a>';
}

include("includes/fin.php"); ?>
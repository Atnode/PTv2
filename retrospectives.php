<?php
session_start();
$titre = "Planète Toad &bull; Encyclopédie des rétrospectives";
$descrip = "L'encyclopédie contient des rétrospectives sur les principaux personnes de l'univers Mario. ";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
$query=$db->prepare('SELECT COUNT(*) FROM retrospectives');
$query->execute();
$nbrfiches=$query->fetchColumn();
?>
<div id="filariane">>> <a href="./">Index</a> --> <a href="./retrospectives.html">Encyclopédie des rétrospectives</a></div>
<br><h1>Rétrospectives</h1>
<p>L'encyclopédie contient des rétrospectives de l'univers Mario. Elles définissent chronologiquement, l'histoire et l'évolution des principaux personnages. Vous pouvez y contribuer en y ajoutant des fiches, en récompense, vous gagnerez des <b>Champis</b>. Pour cela, il suffit juste d'être inscrit sur Planète Toad. L'encyclopédie contient <?php echo'<b>'.$nbrfiches.'</b>';?> rétrospectives, qui est en constante augmentation.</p><br>
<?php
$query=$db->prepare('SELECT * FROM retrospectives ORDER BY id desc LIMIT 10');
$query->execute() or die(print_r($query->errorInfo()));
while($data = $query->fetch()) {
	echo'<a href="/retrospective-'.$data['id'].'-'.$data['nom_url'].'.html"><div class="commentaires" style="text-align:center;"><div style="float:left;">
	<img src="'.$data['image'].'" title="Image de '.$data['personnage'].'" alt="Image de '.$data['personnage'].'" style="max-width:200px;max-height:200px;" /></div>
	<div style="width:80%;"><b><u>'.$data['personnage'].'</u></b><br><br>
	'.substr($data['contenu'], 0,750).'...<br><br>
    >>Plus d\'infos ici &lt;&lt;</div><div class="clearboth"></div></div></a>';
    $perso = $data['id'];
}

include("includes/fin.php"); ?>
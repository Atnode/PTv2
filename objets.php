<?php
session_start();
$titre = "Planète Toad &bull; Encyclopédie des objets";
$descrip = "L'encyclopédie contient des fiches biographiques sur les objets de l'univers Mario, utile si vous voulez approfondir vos connaissances ou y contribuer";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
$query=$db->prepare('SELECT COUNT(*) FROM objets WHERE valide = "1"');
$query->execute();
$nbrfiches=$query->fetchColumn();
?>
<div id="filariane">>> <a href="./">Index</a> --> <a href="./objets.html">Encyclopédie des objets</a></div>
<br><h1>Objets</h1>
<p>L'encyclopédie contient des fiches biographiques sur les objets de l'univers Mario. Vous pouvez y contribuer en y ajoutant des fiches, en récompense, vous gagnerez des <b>Champis</b>. Pour cela, il suffit juste d'être inscrit sur Planète Toad. L'encyclopédie contient <?php echo'<b>'.$nbrfiches.'</b>';?> fiches des objets, qui est en constante augmentation.</p><br>
<?php if ($id!=0) { echo'<a href="/add-objet.php"><img src="./images/nouveau.png" alt="Ajouter une nouvelle fiche" title="Ajouter une nouvelle fiche"></a><br><br>'; }
$query=$db->prepare('SELECT * FROM objets WHERE valide= "1" ORDER BY id desc');
$query->execute() or die(print_r($query->errorInfo()));
while($data = $query->fetch()) {
 	echo'<a href="/objet-'.$data['id'].'-'.$data['nom_url'].'.html"><div class="card">
      <div style="margin-left:auto;margin-right:auto;height:200px;width:200px;"><img src="'.$data['image'].'" title="Image de '.$data['nom_objet'].'" alt="Image de '.$data['nom_objet'].'" style="max-width:200px;max-height:200px;" /></div>
        <br><br><div style="text-align:center;"><span style="color:#039be5;text-transform:uppercase;">'.$data['nom_objet'].'</span><br>
      </div><br><br>
    </div></a>';}

include("includes/fin.php"); ?>
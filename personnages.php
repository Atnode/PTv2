<?php
session_start();
$titre = "Planète Toad &bull; Encyclopédie des personnages";
$descrip = "L'encyclopédie contient des fiches biographiques sur les personnages de l'univers Mario, utile si vous voulez approfondir vos connaissances ou y contribuer";
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
$query=$db->prepare('SELECT COUNT(*) FROM personnages WHERE valide = "1"');
$query->execute();
$nbrfiches=$query->fetchColumn();
?>
<div id="filariane">>> <a href="./">Index</a> --> <a href="./personnages.html">Encyclopédie des personnages</a></div>
<br><h1>Personnages</h1>
<p>L'encyclopédie contient des fiches biographiques sur les personnages de l'univers Mario. Vous pouvez y contribuer en y ajoutant des fiches, en récompense, vous gagnerez des <b>Champis</b>. Pour cela, il suffit juste d'être inscrit sur Planète Toad. L'encyclopédie contient <?php echo'<b>'.$nbrfiches.'</b>';?> fiches des personnages, qui est en constante augmentation.</p><br>
<?php if ($id!=0) { echo'<a href="/add-perso.php"><img src="./images/nouveau.png" alt="Ajouter une nouvelle fiche" title="Ajouter une nouvelle fiche"></a><br><br>'; }
$query=$db->prepare('SELECT * FROM personnages WHERE valide= "1" ORDER BY nom_perso ASC');
$query->execute() or die(print_r($query->errorInfo()));
while($data = $query->fetch()) {
 	echo'<a href="/personnage-'.$data['id'].'-'.$data['nom_url'].'.html"><div class="card">
      <div style="margin-left:auto;margin-right:auto;height:200px;width:200px;"><img src="'.$data['image'].'" title="Image de '.$data['nom_perso'].'" alt="Image de '.$data['nom_perso'].'" style="max-width:200px;max-height:200px;" /></div>
        <br><br><div style="text-align:center;"><span style="color:#039be5;text-transform:uppercase;">'.$data['nom_perso'].'</span><br>
      </div><br><br>
    </div></a>';
}

include("includes/fin.php"); ?>
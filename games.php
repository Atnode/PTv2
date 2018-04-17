<?php
session_start();
include("./includes/identifiants.php");
$titre =  'Planète Toad &bull; Encyclopédie des jeux';
$descrip = "L'encyclopédie contient des fiches biographiques sur les jeux de l'univers Mario, utile si vous voulez approfondir vos connaissances ou y contribuer";
include("./includes/debut.php");
include("./includes/menu.php");
$query=$db->prepare('SELECT COUNT(*) FROM jeux');
$query->execute();
$nbrfiches=$query->fetchColumn();
?>
<div id="filariane">>> <a href="./">Index</a> --> <a href="./jeux.html">Encyclopédie des jeux</a></div>
<br><h1>Jeux</h1>
<p>L'encyclopédie contient des fiches biographiques sur les jeux de l'univers Mario. Vous pouvez y rechercher des informations sur un jeu, ou alors proposer des astuces, un test, ou encore créer une partie en ligne. L'encyclopédie contient <?php echo'<b>'.$nbrfiches.'</b>';?> fiches de jeux, qui est en constante augmentation.</p><br>
<?php
$query=$db->prepare('SELECT * FROM jeux ORDER BY sortie_ue DESC');
$query->execute();
echo'<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"><thead>
        <tr>
          <th class="mdl-data-table__cell--non-numeric">CONSOLE</th>
          <th class="mdl-data-table__cell--non-numeric">NOM</th>
          <th class="mdl-data-table__cell--non-numeric">DEVELOPPEUR/EDITEUR</th>
          <th>SORTIE EUROPE</th>
        </tr>
      </thead>
      <tbody>';
while ($data=$query->fetch()) {
	echo'<tr style="margin:2px;"><td class="mdl-data-table__cell--non-numeric" style="padding:3px;"><div class="'.$data['console'].'">'.$data['console'].'</div></td>
	<td style="padding:3px;" class="mdl-data-table__cell--non-numeric"><a href="game-'.$data['id'].'-'.$data['nom_url'].'.html">'.$data['nom'].'</a></td>
	<td style="padding:3px;" class="mdl-data-table__cell--non-numeric">'.$data['developpeur'].'/'.$data['editeur'].'</td>
	<td style="padding:3px;">';
    $age = $data['sortie_ue'];
    $date = date_parse($age);
    $jour = $date['day'];
    $mois = $date['month'];
    $annee = $date['year'];
    echo ''.$jour.' '.getMonth($mois).' '.$annee.'</td></tr>';
}
echo'</tbody></table><br><br>';
include("./includes/fin.php");
?>
<?php
session_start();
$titre="Planète Toad &bull; Awards 2016";
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$admin = 1;
include("../includes/identifiants.php");
include("../includes/debut.php");
if ($lvl<3) header('Location: ../erreur_404.html'); 
include("../includes/menu.php");
?>
<h1>Awards 2016</h1>

<?php /*
$actua=$db->prepare('SELECT * FROM forum_membres');
$actua->execute();
while ($actu = $actua->fetch()) {
	// POUR LES POSTS
	$actua2=$db->prepare('SELECT post_id FROM forum_post WHERE post_createur = '.$actu['membre_id'].' AND post_time > "1451602800"');
  $actua2->execute();
	$actu2 = $actua2->rowCount();
	$actua3=$db->prepare('INSERT INTO awards2016 (id_membre, nombre, typeRecomp) VALUES('.$actu['membre_id'].', '.$actu2.', 1)');
	$actua3->execute();

	// POUR LES TOPICS
	$actua3=$db->prepare('SELECT topic_id FROM forum_topic WHERE topic_createur = '.$actu['membre_id'].' AND topic_time > "1451602800"');
  $actua3->execute();
	$actu3 = $actua3->rowCount();
	$actua4=$db->prepare('INSERT INTO awards2016 (id_membre, nombre, typeRecomp) VALUES('.$actu['membre_id'].', '.$actu3.', 2)');
	$actua4->execute();

	// POUR LES PUBLICATEURS
	$actua4=$db->prepare('SELECT id FROM publications WHERE id_posteur = '.$actu['membre_id'].' AND timestamp > "1451602800" AND officielle <> 1');
  $actua4->execute();
	$actu4 = $actua4->rowCount();
	$actua5=$db->prepare('INSERT INTO awards2016 (id_membre, nombre, typeRecomp) VALUES('.$actu['membre_id'].', '.$actu4.', 3)');
	$actua5->execute();

	// POUR LES COMMENTATEURS DE NEWS
	$actua5=$db->prepare('SELECT id FROM commentaires WHERE id_posteur = '.$actu['membre_id'].' AND timestamp > "1451602800"');
  $actua5->execute();
	$actu5 = $actua5->rowCount();
	$actua6=$db->prepare('INSERT INTO awards2016 (id_membre, nombre, typeRecomp) VALUES('.$actu['membre_id'].', '.$actu5.', 4)');
	$actua6->execute();

	// POUR LES NEWSER
	$actua6=$db->prepare('SELECT id FROM news WHERE posteur_id = '.$actu['membre_id'].' AND timestamp > "1451602800"');
  $actua6->execute();
	$actu6 = $actua6->rowCount();
	$actua7=$db->prepare('INSERT INTO awards2016 (id_membre, nombre, typeRecomp) VALUES('.$actu['membre_id'].', '.$actu6.', 5)');
	$actua7->execute();
} */

// Pour les posts
echo'<br><br><h2>Meilleurs posteurs</h2>';
$NumberP = 1;
$retour = $db->prepare('SELECT * FROM awards2016 LEFT JOIN forum_membres ON forum_membres.membre_id = awards2016.id_membre WHERE typeRecomp = 1 ORDER BY nombre DESC LIMIT 0, 10');
$retour->execute();
echo'<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"><thead>
        <tr>
          <th>POSITION</th>
          <th class="mdl-data-table__cell--non-numeric">MEMBRE</th>
          <th>NOMBRE</th>
        </tr>
      </thead>
      <tbody>
';
while ($donnees = $retour->fetch())
{
echo'<tr>
          <td>'.$NumberP.'</td>
          <td class="mdl-data-table__cell--non-numeric"><a href="/profil-'.$donnees['membre_id'].'.html" style="color:'.$donnees['membre_couleur'].';">'.$donnees['membre_pseudo'].'</a></td>
          <td>'.$donnees['nombre'].'</td>
        </tr>';
$NumberP++;
}
echo'</tbody></table>';

// Pour les topics
echo'<br><br><h2>Meilleurs topiceurs</h2>';
$NumberT = 1;
$retour = $db->prepare('SELECT * FROM awards2016 LEFT JOIN forum_membres ON forum_membres.membre_id = awards2016.id_membre WHERE typeRecomp = 2 ORDER BY nombre DESC LIMIT 0, 10');
$retour->execute();
echo'<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"><thead>
        <tr>
          <th>POSITION</th>
          <th class="mdl-data-table__cell--non-numeric">MEMBRE</th>
          <th>NOMBRE</th>
        </tr>
      </thead>
      <tbody>
';
while ($donnees = $retour->fetch())
{
echo'<tr>
          <td>'.$NumberT.'</td>
          <td class="mdl-data-table__cell--non-numeric"><a href="/profil-'.$donnees['membre_id'].'.html" style="color:'.$donnees['membre_couleur'].';">'.$donnees['membre_pseudo'].'</a></td>
          <td>'.$donnees['nombre'].'</td>
        </tr>';
$NumberT++;
}
echo'</tbody></table>';

// Pour les publicateurs
echo'<br><br><h2>Meilleurs publicateurs</h2>';
$NumberPu = 1;
$retour = $db->prepare('SELECT * FROM awards2016 LEFT JOIN forum_membres ON forum_membres.membre_id = awards2016.id_membre WHERE typeRecomp = 3 ORDER BY nombre DESC LIMIT 0, 10');
$retour->execute();
echo'<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"><thead>
        <tr>
          <th>POSITION</th>
          <th class="mdl-data-table__cell--non-numeric">MEMBRE</th>
          <th>NOMBRE</th>
        </tr>
      </thead>
      <tbody>
';
while ($donnees = $retour->fetch())
{
echo'<tr>
          <td>'.$NumberPu.'</td>
          <td class="mdl-data-table__cell--non-numeric"><a href="/profil-'.$donnees['membre_id'].'.html" style="color:'.$donnees['membre_couleur'].';">'.$donnees['membre_pseudo'].'</a></td>
          <td>'.$donnees['nombre'].'</td>
        </tr>';
$NumberPu++;
}
echo'</tbody></table>';

// Pour les commentateursDeNews
echo'<br><br><h2>Meilleurs commentateursDeNews</h2>';
$NumberCN = 1;
$retour = $db->prepare('SELECT * FROM awards2016 LEFT JOIN forum_membres ON forum_membres.membre_id = awards2016.id_membre WHERE typeRecomp = 4 ORDER BY nombre DESC LIMIT 0, 10');
$retour->execute();
echo'<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"><thead>
        <tr>
          <th>POSITION</th>
          <th class="mdl-data-table__cell--non-numeric">MEMBRE</th>
          <th>NOMBRE</th>
        </tr>
      </thead>
      <tbody>
';
while ($donnees = $retour->fetch())
{
echo'<tr>
          <td>'.$NumberCN.'</td>
          <td class="mdl-data-table__cell--non-numeric"><a href="/profil-'.$donnees['membre_id'].'.html" style="color:'.$donnees['membre_couleur'].';">'.$donnees['membre_pseudo'].'</a></td>
          <td>'.$donnees['nombre'].'</td>
        </tr>';
$NumberCN++;
}
echo'</tbody></table>';

// Pour les newsers
echo'<br><br><h2>Meilleurs newsers</h2>';
$NumberN = 1;
$retour = $db->prepare('SELECT * FROM awards2016 LEFT JOIN forum_membres ON forum_membres.membre_id = awards2016.id_membre WHERE typeRecomp = 5 ORDER BY nombre DESC LIMIT 0, 10');
$retour->execute();
echo'<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"><thead>
        <tr>
          <th>POSITION</th>
          <th class="mdl-data-table__cell--non-numeric">MEMBRE</th>
          <th>NOMBRE</th>
        </tr>
      </thead>
      <tbody>
';
while ($donnees = $retour->fetch())
{
echo'<tr>
          <td>'.$NumberN.'</td>
          <td class="mdl-data-table__cell--non-numeric"><a href="/profil-'.$donnees['membre_id'].'.html" style="color:'.$donnees['membre_couleur'].';">'.$donnees['membre_pseudo'].'</a></td>
          <td>'.$donnees['nombre'].'</td>
        </tr>';
$NumberN++;
}
echo'</tbody></table>';
include("../includes/fin.php");
?>
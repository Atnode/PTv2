<?php
session_start();
$id_game = (int) $_GET['id'];
$astucesGame = 1;
include("./includes/identifiants.php");
$reponse = $db->prepare('SELECT * FROM jeux WHERE id='.$id_game.'');
$reponse->execute();
$donnees = $reponse->fetch();
$titre =  'Astuces de '.$donnees['nom'].' &bull; Planète Toad';
$descrip = "Consulter les astuces du jeu ".$donnees['nom']." sur le site Planète Toad";
$balises = true;
include("./includes/debut.php");
include("./includes/menu.php");
include("./includes/headergame.php");
include("./includes/bbcode.php");

echo '<div class="corps" style="margin-top:-12.999px;"><div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./encyclopedie.html">Encyclopedie</a> --> <a href="./jeux.html">Jeux</a> -->
<a href="./game-'.$id_game.'-'.$donnees['nom_url'].'.html">'.$donnees['nom'].'</a> --> <a href="/astuces-game-'.$id_game.'-'.$donnees['nom_url'].'.html">Astuces</a></div><br>';
echo'<h1>Astuces de '.$donnees['nom'].'</h1><br><br>
<p style="text-align:center;">Voici les astuces de <b>'.$donnees['nom'].'</b>. Vous pouvez bien entendu en poster si vous êtes membre, cela vous rapporte même 5 <img src="champi.png" alt="Champis" title="5 Champis" /> si elle est validée par un rédacteur. Cependant, votre astuce ne doit pas être prise d\'un autre site, et doit être véridique.</p><br><br>';
if ($id!=0) {
echo'<form method="post" action="astuces-game-'.$id_game.'-'.$donnees['nom_url'].'.html"><div style="text-align:center;">';
include("code.php");
echo'<br><br>
<input type="text" id="titre" name="titre" placeholder="Titre de l\'astuce..."><br><br>
<textarea cols="50" rows="6" name="message" id="message" placeholder="Astuce..."></textarea><br><input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer" /></div></form><br><hr />';
}

// LISTE DES ASTUCES
$query=$db->prepare('SELECT * FROM astuces LEFT JOIN jeux ON jeux.id = astuces.id_game LEFT JOIN forum_membres ON forum_membres.membre_id = astuces.id_posteur WHERE id_game ='.$id_game.' AND valide = 1 ORDER BY timestamp DESC');
$query->execute();
if ($query->rowCount()>0) {
while ($data=$query->fetch()) {
	echo'<i class="material-icons">chevron_right</i> <a href="#astuce'.stripslashes(htmlspecialchars($data['id_astuce'])).'">'.stripslashes(htmlspecialchars($data['titre'])).'</a>';
}
}

$query=$db->prepare('SELECT * FROM astuces LEFT JOIN jeux ON jeux.id = astuces.id_game LEFT JOIN forum_membres ON forum_membres.membre_id = astuces.id_posteur WHERE id_game ='.$id_game.' AND valide = 1 ORDER BY timestamp DESC');
$query->execute();
if ($query->rowCount()>0) {
while ($data=$query->fetch()) {
	echo'<div class="commentaires"><span style="font-weight:bold;text-size:16px;" id="astuce'.stripslashes(htmlspecialchars($data['id_astuce'])).'">'.stripslashes(htmlspecialchars($data['titre'])).'</span>
	<p>'.code(nl2br(stripslashes(htmlspecialchars($data['astuce'])))).'</p></td>
</tr></table><div style="text-align:right;font-style:italic;">Publiée par <a href="/profil-'.htmlentities(stripslashes($data['membre_id'])).'.html" style="color:'.$data['membre_couleur'].'">'.htmlentities(stripslashes($data['membre_pseudo']), ENT_QUOTES, "UTF-8").'</a></div></div>';
}
} else { echo'<p style="text-align:center;">Ce jeu ne comporte aucune astuce pour l\'instant.</p>'; }

if (isset($_POST['titre']) AND isset($_POST['message']) AND $id!=0) {
	// Bah on envoie
    $titre = $_POST['titre'];
    $message = $_POST['message'];
    $query = $db->prepare('INSERT INTO astuces (id_game,id_posteur,titre,astuce,timestamp,valide) VALUES(:id_game,:id_posteur,:titre,:message,:timestamp,:valide)');
    $query->bindValue(':id_game',$id_game,PDO::PARAM_INT);
    $query->bindValue(':id_posteur',$id,PDO::PARAM_INT);
    $query->bindValue(':titre',$titre,PDO::PARAM_STR);
    $query->bindValue(':message',$message,PDO::PARAM_STR);
	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
	$query->bindValue(':valide',"0",PDO::PARAM_INT);
	$query->execute();
	echo'<br><span style="font-weight:bold;color:green;text-align:center;">Votre astuce a été publiée, mais requiert la validation d\'un rédacteur.</span>';
}

include("includes/fin.php"); ?>

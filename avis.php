<?php
session_start();
$id_game = (int) $_GET['id'];
$avisGame = 1;
include("./includes/identifiants.php");
$reponse = $db->prepare('SELECT * FROM jeux WHERE id='.$id_game.'');
$reponse->execute();
$donnees = $reponse->fetch();
$titre =  'Avis de '.$donnees['nom'].' &bull; Planète Toad';
$descrip = "Consulter les avis des membres du jeu ".$donnees['nom']." sur le site Planète Toad";
$balises = true;
include("./includes/debut.php");
include("./includes/menu.php");
include("./includes/headergame.php");
include("./includes/bbcode.php");

echo '<div class="corps" style="margin-top:-12.999px;"><div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./encyclopedie.html">Encyclopedie</a> --> <a href="./jeux.html">Jeux</a> -->
<a href="./game-'.$id_game.'-'.$donnees['nom_url'].'.html">'.$donnees['nom'].'</a> --> <a href="/avis-game-'.$id_game.'-'.$donnees['nom_url'].'.html">Avis</a></div><br>';
echo'<h1>Avis de '.$donnees['nom'].'</h1><br><br>
<p style="text-align:center;">Voici les avis des membres de <b>'.$donnees['nom'].'</b>. Vous pouvez bien entendu en poster si vous êtes membre, cela vous rapporte même 3 <img src="champi.png" alt="Champis" title="3 Champis" /> si elle est validée par un rédacteur. Cependant, votre avis doit faire au moins 50 caractères et doit être argumenté.</p><br>';
      $noteGAME = $db->prepare('SELECT AVG(note) AS moyenneNotes FROM avis WHERE valide = 1 AND id_game = '.$id_game.'');
	  $noteGAME->execute();
	  $noteMoyenne = $noteGAME->fetch();
echo'<div style="text-align:center;">La note moyenne atribuée est de <b>'.substr($noteMoyenne['moyenneNotes'], 0, 5).'/20</b>.</div><br>';
if ($id!=0) {
$Dejaposte = $db->query('SELECT * FROM avis WHERE id_posteur = '.$id.' AND id_game = '.$id_game.'');
if ($Dejaposte->fetch() == false)
{
echo'<form method="post" action="avis-game-'.$id_game.'-'.$donnees['nom_url'].'.html"><div style="text-align:center;">';
include("code.php");
echo'<br><br>
<b>Note :</b><br>
<select name="note"><option value="0">0/20</option>
<option value="1">1/20</option>
<option value="2">2/20</option>
<option value="3">3/20</option>
<option value="4">4/20</option>
<option value="5">5/20</option>
<option value="6">6/20</option>
<option value="7">7/20</option>
<option value="8">8/20</option>
<option value="9">9/20</option>
<option value="10">10/20</option>
<option value="11">11/20</option>
<option value="12">12/20</option>
<option value="13">13/20</option>
<option value="14">14/20</option>
<option value="15">15/20</option>
<option value="16">16/20</option>
<option value="17">17/20</option>
<option value="18">18/20</option>
<option value="19">19/20</option>
<option value="20">20/20</option></select><br><br>
<textarea cols="50" rows="6" name="message" id="message" placeholder="Votre avis..."></textarea><br><input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer" /></div></form><br><hr />';

// Validation
if (isset($_POST['message']) AND $id!=0) {
	if ($_POST['note']>=0 AND $_POST['note']<=20) {
	// Bah on envoie
    $titre = $_POST['titre'];
    $message = $_POST['message'];
    $note = $_POST['note'];
    $query = $db->prepare('INSERT INTO avis (id_game,id_posteur,avis,note,timestamp,valide) VALUES(:id_game,:id_posteur,:avis,:note,:timestamp,:valide)');
    $query->bindValue(':id_game',$id_game,PDO::PARAM_INT);
    $query->bindValue(':id_posteur',$id,PDO::PARAM_INT);
    $query->bindValue(':avis',$message,PDO::PARAM_STR);
    $query->bindValue(':note',$note,PDO::PARAM_INT);
	$query->bindValue(':timestamp',time(),PDO::PARAM_INT);
	$query->bindValue(':valide',"0",PDO::PARAM_INT);
	$query->execute();
	echo'<br><span style="font-weight:bold;color:green;text-align:center;">Votre astuce a été publiée, mais requiert la validation d\'un rédacteur.</span>';
    }
}
}
}
$query=$db->prepare('SELECT * FROM avis LEFT JOIN jeux ON jeux.id = avis.id_game LEFT JOIN forum_membres ON forum_membres.membre_id = avis.id_posteur WHERE id_game ='.$id_game.' AND valide = 1 ORDER BY timestamp DESC');
$query->execute();
if ($query->rowCount()>0) {
while ($data=$query->fetch()) {
	echo'<div class="commentaires"><table style="width:98%;"><tr>';
echo'<td style="width:85px;"><a href="/profil-'.htmlentities(stripslashes($data['membre_id'])).'.html"><img src="'.htmlentities(stripslashes($data['membre_avatar'])).'" alt="avatar" style="vertical-align:top;max-width:75px;max-height:75px;margin:3px;border-radius:50%;" /></a></td>
<td><p>'.code(nl2br(stripslashes(htmlspecialchars($data['avis'])))).'</p></td>
</tr></table><div style="text-align:right;font-style:italic;"><a href="/profil-'.htmlentities(stripslashes($data['membre_id'])).'.html" style="color:'.$data['membre_couleur'].'">'.htmlentities(stripslashes($data['membre_pseudo']), ENT_QUOTES, "UTF-8").'</a> a attribué à la note de '.htmlentities(stripslashes($data['note'])).'/20</div></div>';
}
} else { echo'<p style="text-align:center;">Ce jeu ne comporte aucun avis pour l\'instant.</p>'; }
include("includes/fin.php"); ?>

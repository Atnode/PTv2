<?php
session_start();
$titre = "Planète Toad &bull; Livre d'or";
$descrip = "Le livre d'or est un espace où vous pouvez voir et laisser un avis sur le site. Ecrivez ce que vous pensez, détaillez-le si possible.";
$canonical = "http://www.planete-toad.fr/livreor.html";
$balises = true;
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
include("includes/bbcode.php");
?>
<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./livreor.html">Livre d'or</a></div><br />
<h1>Livre d'or</h1>
<p align=center>Vous avez envie de laisser votre avis pour le site ? Le livre d'or est là pour ça. Ecrivez ce que vous pensez du site. Détaillez un peu vos avis, c'est inutile de dire "ce site est nul" ou d'autre trucs dans le genre.</p>
<br><?php
      $query = $db->prepare('SELECT AVG(note) AS moyenneNotes FROM livreor');
		$query->execute();
		$data = $query->fetch();
echo'<div style="text-align:center;">La note moyenne atribuée est de <b>'.substr($data['moyenneNotes'], 0, 5).'/20</b>.</div><br>';
if ($id!=0) {
$Dejaposte = $db->query('SELECT * FROM livreor WHERE id_posteur = '. $id .'');
if ($Dejaposte->fetch() == false)
{
echo'<form method="post" action="livreor.html"><div style="text-align:center;">';
include("code.php"); ?>
</div><p align=center><b>Commentaire :</b><br /><textarea cols="50" rows="6" name="message" id="message"></textarea><br />
<b>Note :</b><br />
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
<option value="20">20/20</option></select><br />
<br /><input class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer" /></p></form><hr />
<?php
if (isset($_POST['message']) && isset($_POST['note']))	
{
	if ($_POST['note']>=0 AND $_POST['note']<=20) {
      $commentaire = $_POST['message'];
      $note = $_POST['note'];
      $query = $db->prepare('INSERT INTO livreor (id_posteur,commentaire,note) VALUES(:posteur_id, :commentaire, :note)');
      $query->bindValue(':posteur_id',$id,PDO::PARAM_INT);
		$query->bindValue(':commentaire',$commentaire,PDO::PARAM_STR);
		$query->bindValue(':note',$note,PDO::PARAM_INT);
		$query->execute();
	}
}
} else { echo'<div style="text-align:center; font-weight:bold;">Vous ne pouvez poster qu\'un seul message sur le livre d\'or. </div><hr />'; } }
$query = $db->prepare('SELECT membre_id, membre_pseudo, membre_avatar, membre_couleur, id_posteur, id, commentaire, note FROM livreor LEFT JOIN forum_membres ON membre_id = id_posteur ORDER BY id DESC'); 
$query->execute();
while($data = $query->fetch())
{

if ($query->rowCount() > 0)
{
echo'<div class="commentaires"><table style="width:98%;"><tr>';
echo'<td style="width:85px;"><a href="/profil-'.htmlentities(stripslashes($data['membre_id'])).'.html"><img src="'.htmlentities(stripslashes($data['membre_avatar'])).'" alt="avatar" style="vertical-align:top; max-width:75px; max-height:75px; margin:3px; border-radius:50%;" /></a></td>
<td><p>'.code(nl2br(stripslashes(htmlspecialchars($data['commentaire'])))).'</p></td>';
if ($data['id_posteur']==$id OR $lvl>3){echo'<div style="text-align:right;font-style:italic;"><a href="./guestbook-suppr.php?id='.$data['id'].'"><i class="material-icons md-18" style="color:red;">close</i></a></div>';}
echo'</tr></table><div style="text-align:right;font-style:italic;"><a href="/profil-'.htmlentities(stripslashes($data['membre_id'])).'.html" style="color:'.$data['membre_couleur'].'">'.htmlentities(stripslashes($data['membre_pseudo']), ENT_QUOTES, "UTF-8").'</a> a attribué à la note de '.htmlentities(stripslashes($data['note'])).'/20</div></div>';
} else { echo'Il n\'y a aucun commentaire sur le livre d\'or.'; }
}
include("includes/fin.php");
?>
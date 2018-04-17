<?php
session_start();
$perso = (int) $_GET['id'];
include("./includes/identifiants.php");
$reponse = $db->query('SELECT nom_perso FROM personnages WHERE id='.$perso.''); 
$reponse->execute();
$donnees = $reponse->fetch();
$titre =  ''.$donnees['nom_perso'].' &bull; Planète Toad';
include("./includes/debut.php");
include("./includes/menu.php");
$query=$db->prepare('SELECT * FROM personnages LEFT JOIN forum_membres ON forum_membres.membre_id = personnages.id_posteur LEFT JOIN jeux ON jeux.id = personnages.premiere_apparition WHERE personnages.id ='.$perso.' AND valide= "1"');
$query->execute();
$data=$query->fetch();
if ($query->rowCount()<1)
{ header('Location: http://www.planete-toad.fr/erreur_403.html'); } else {
$derniereapparitionEncyclo=$db->prepare('SELECT * FROM personnages LEFT JOIN jeux ON jeux.id = personnages.derniere_apparition WHERE personnages.id ='.$perso.' AND valide= "1"');
$derniereapparitionEncyclo->execute();
$derniereapp = $derniereapparitionEncyclo->fetch();

echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./personnages.html">Encyclopedie : personnages</a> -->
<a href="./personnage-'.$perso.'-'.$data['nom_url'].'.html">Fiche de '.$data['nom_perso'].'</a></div><br>';
echo'<h1>'.$data['nom_perso'].'</h1>
<br><br><h2>Informations</h2><br><div class="commentaires">
<table><tr><td style="border-right:1px solid #d8d8d8;padding:5px;"><img src="'.$data['image'].'" alt="Image de '.$data['nom_perso'].'" title="Image de '.$data['nom_perso'].'" /></div></td>
    <td style="vertical-align:middle;padding:5px;">
    <b><u>'.$data['nom_perso'].'</u></b><br>
	<b>Première apparition :</b>'; if (!empty($data['id'])) { echo'<a href="game-'.$data['id'].'-'.$data['nom_url'].'.html">'.$data['nom'].'</a>'; }
	echo'<br><b>Dernière apparition :</b>'; if (!empty($derniereapp['id'])) { echo' <a href="game-'.$derniereapp['id'].'-'.$derniereapp['nom_url'].'.html">'.$derniereapp['nom'].'</a>'; }
	echo'<br><b>Alias :</b> '.$data['alias'].'<br>
	<b>Sexe :</b> '.$data['sexe'].'<br>
	<b>Espèce :</b> '.$data['espece'].'<br>';
	if ($data['citation']!=NULL)  {echo'<b>Citation :</b> <i>«'.$data['citation'].'»</i><br>';}
	echo'</td>
</tr></table></div><br>
<br><h2>Biographie</h2><br>
<p style="padding:4px;">'.stripslashes(nl2br($data['texte'])).'</p><br><br><br>
<h2>Galerie</h2><br><hr /><div style="text-align:right;font-style:italic;">Par <a href="./profil-'.$data['membre_id'].'.html" style="color:'.$data['membre_couleur'].';">
'.$data['membre_pseudo'].'</a></div>';
}
include("includes/fin.php"); ?>
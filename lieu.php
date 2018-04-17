<?php
session_start();
$lieu = (int) $_GET['id'];
include("./includes/identifiants.php");
$reponse = $db->query('SELECT nom_lieu FROM lieux WHERE id='.$lieu.''); 
$reponse->execute();
$donnees = $reponse->fetch();
$titre =  ''.$donnees['nom_lieu'].' &bull; Planète Toad';
include("./includes/debut.php");
include("./includes/menu.php");
$query=$db->prepare('SELECT * FROM lieux LEFT JOIN forum_membres ON forum_membres.membre_id = lieux.id_posteur WHERE id='.$lieu.' AND valide= "1"');
$query->execute();
$data=$query->fetch();
if ($query->rowCount()<1)
{ header('Location: http://www.planete-toad.fr/erreur_403.html'); } else {
echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./lieu.html">Encyclopedie : lieu</a> -->
<a href="./personnage-'.$lieu.'-'.$data['nom_url'].'.html">Fiche de '.$data['nom_lieu'].'</a></div><br>';
echo'<h1>'.$data['nom_lieu'].'</h1>
<br><br><h2>Informations</h2><br><div class="commentaires">
<table style="margin-left:auto;margin-right:auto;"><tr><td style="border-right:1px solid #d8d8d8;padding:5px;"><img src="'.$data['image'].'" alt="Image de '.$data['nom_lieu'].'" title="Image de '.$data['nom_lieu'].'" /></div></td>
    <td style="vertical-align:middle;padding:5px;">
    <b><u>'.$data['nom_lieu'].'</u></b><br>
	<b>Première apparition :</b> '.$data['premiere_apparition'].'<br>
	<b>Dernière apparition :</b> '.$data['derniere_apparition'].'<br>
	<b>Alias :</b> '.$data['alias'].'<br>
	</td>
</tr></table></div><br>
<br><h2>Biographie</h2><br>
<p style="padding:4px;">'.stripslashes(nl2br($data['texte'])).'</p><br><br><br>
<h2>Galerie</h2><br><hr /><div style="text-align:right;font-style:italic;">Par <a href="./profil-'.$data['membre_id'].'.html" style="color:'.$data['membre_couleur'].';">
'.$data['membre_pseudo'].'</a></div>';
}
include("includes/fin.php"); ?>
<?php
session_start();
$perso = (int) $_GET['id'];
include("./includes/identifiants.php");
$reponse = $db->query('SELECT personnage FROM retrospectives WHERE id='.$perso.''); 
$reponse->execute();
$donnees = $reponse->fetch();
$titre =  'Rétrospective de '.$donnees['personnage'].' &bull; Planète Toad';
$descrip = "Consulter la rétrospective de ".$donnees['personnage']." le site Planète Toad";
include("./includes/debut.php");
include("./includes/menu.php");
$query=$db->prepare('SELECT * FROM retrospectives LEFT JOIN forum_membres ON forum_membres.membre_id = retrospectives.id_posteur WHERE id='.$perso.'');
$query->execute();
$data=$query->fetch();
if ($query->rowCount()<1)
{ header('Location: http://www.planete-toad.fr/erreur_403.html'); } else {
echo '<div id="filariane"><i>Vous êtes ici</i> : <a href="./">Index</a> --> <a href="./retrospectives.html">Encyclopedie : rétrospectives</a> -->
<a href="./retrospective-'.$perso.'-'.$data['nom_url'].'.html">Rétrospective de '.$data['personnage'].'</a></div><br>';
echo'<h1>'.$data['personnage'].'</h1>
<br><br><div style="text-align:center;"><img src="'.$data['image'].'" alt="Image de '.$data['personnage'].'" title="Image de '.$data['personnage'].'" /></div><br>
<br><p style="padding:4px;">'.stripslashes(nl2br($data['contenu'])).'</p><hr /><div style="text-align:right;font-style:italic;">Par <a href="./profil-'.$data['membre_id'].'.html" style="color:'.$data['membre_couleur'].';">
'.$data['membre_pseudo'].'</a></div>';
}
include("includes/fin.php"); ?>